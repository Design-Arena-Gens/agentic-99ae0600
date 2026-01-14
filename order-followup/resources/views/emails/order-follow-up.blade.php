@php($orderDate = $order->order_date?->format('d M Y'))

<p>Hi {{ $order->customer_name }},</p>

<p>We hope you are enjoying your order placed on {{ $orderDate }}. We would love to hear your feedback or help if you need any assistance.</p>

<p>Feel free to reply to this email or reach out to us on WhatsApp.</p>

<p>Thank you,<br>
Customer Success Team</p>
