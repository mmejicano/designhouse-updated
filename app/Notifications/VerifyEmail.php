<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Auth\Notifications\VerifyEmail as Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;

// use Illuminate\Notifications\Notification;

class VerifyEmail extends Notification
{
    protected function verificationUrl($notificable)
    {
        $appUrl = config('app.client_url', config('app.url'));
        $url = URL::temporarySignedRoute(
            'verification.verify', Carbon::now()->addMinutes(60),
            ['user' => $notificable->id]
        );
        // result = http://localhost:8000/api/xxx
        return str_replace(url('/api'), $appUrl, $url);
    }

}
