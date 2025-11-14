<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use App\Models\UserLoginLog;

class LogUserLogout
{
    public function handle(Logout $event)
    {
        UserLoginLog::where('user_id', $event->user->id)
            ->whereNull('logged_out_at')
            ->latest()
            ->first()
            ?->update([
                'status'        => 'logout',
                'logged_out_at' => now(),
            ]);
    }
}
