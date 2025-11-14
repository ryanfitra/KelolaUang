<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\UserLoginLog;

class LogUserLogin
{
    public function handle(Login $event)
    {
        UserLoginLog::create([
            'user_id'     => $event->user->id,
            'ip_address'  => request()->ip(),
            'user_agent'  => request()->userAgent(),
            'status'      => 'login',
            'logged_in_at' => now(),
        ]);
    }
}
