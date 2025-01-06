<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class AccountApproved extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
{
    try {
        return (new MailMessage)
            ->subject('Your Account Has Been Approved - ' . config('app.name'))
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Great news! Your account has been approved by the administrator.')
            ->line('You can now log in to the system using your email and password.')
            ->action('Login Now', url('/login?force_logout=true'))
            ->line('Thank you for your patience!')
            ->salutation('Best regards, ' . config('app.name') . ' Team');
    } catch (\Exception $e) {
        Log::error('Failed to generate approval email:', [
            'user_id' => $notifiable->id,
            'error' => $e->getMessage()
        ]);
        throw $e;
    }
}
}