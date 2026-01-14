## Order Follow-Up Automation (Laravel)

This Laravel 12 application captures customer orders and automatically sends a follow-up email and WhatsApp message ten days after each order. The follow-up reminders are handled through a scheduled Artisan command that runs daily.

### Features
- Order management UI to add and review customer orders.
- Automatic follow-up detection for orders older than ten days without a sent reminder.
- Email follow-ups via Laravel's mail system.
- WhatsApp follow-ups via Twilio's WhatsApp API (credentials configurable through environment variables).
- Daily scheduler (`orders:send-follow-ups`) to dispatch reminders and record completion timestamps.

### Getting Started
```bash
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate --seed
npm install
npm run build   # or npm run dev for Vite dev server
php artisan serve
```

### Required Environment Variables
Set the following in `.env` to enable WhatsApp delivery:
```
TWILIO_ACCOUNT_SID=your_sid
TWILIO_AUTH_TOKEN=your_token
TWILIO_WHATSAPP_FROM=+14155238886   # Example Sandbox number
MAIL_MAILER=smtp                   # Configure mail transport
MAIL_HOST=your_mail_host
MAIL_PORT=587
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_FROM_ADDRESS=orders@example.com
MAIL_FROM_NAME="Your Store"
```

### Scheduling Follow-Ups
The scheduled task is registered in `routes/console.php`:
```bash
php artisan schedule:run
```
Run the above command every minute via Cron (Laravel's scheduler will handle the daily command execution).

### Deployment Notes
- Ensure the scheduler (`php artisan schedule:run`) is configured on the server.
- Provide Twilio and Mail credentials as runtime environment variables.
- Queue connection defaults to the database driver; run `php artisan queue:work` if you switch the mailer to queue delivery.
- Start a queue worker with `php artisan queue:work` (or configure a supervisor) so queued follow-up emails are processed.
