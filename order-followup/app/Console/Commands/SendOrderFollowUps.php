<?php

namespace App\Console\Commands;

use App\Mail\OrderFollowUpMail;
use App\Models\Order;
use App\Services\WhatsAppService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Throwable;

class SendOrderFollowUps extends Command
{
    protected $signature = 'orders:send-follow-ups';

    protected $description = 'Send follow up email and WhatsApp messages for orders older than 10 days';

    public function handle(WhatsAppService $whatsAppService): int
    {
        $orders = Order::pendingFollowUp()->get();

        if ($orders->isEmpty()) {
            $this->info('No orders pending follow up.');

            return self::SUCCESS;
        }

        $this->info("Processing {$orders->count()} orders...");

        foreach ($orders as $order) {
            try {
                Mail::to($order->customer_email)->send(new OrderFollowUpMail($order));
                $this->line("Email sent to {$order->customer_email}");

                $whatsAppService->send(
                    $order->customer_phone,
                    "Hi {$order->customer_name}, we hope you're enjoying your order from " .
                    $order->order_date?->format('d M Y') .
                    ". Let us know if we can help with anything!"
                );
                $this->line("WhatsApp message sent to {$order->customer_phone}");

                $order->forceFill([
                    'follow_up_sent_at' => now(),
                ])->save();
            } catch (Throwable $exception) {
                Log::error('Failed to send follow up', [
                    'order_id' => $order->id,
                    'error' => $exception->getMessage(),
                ]);

                $this->error("Failed to send follow up for order #{$order->id}. See logs for details.");
            }
        }

        return self::SUCCESS;
    }
}
