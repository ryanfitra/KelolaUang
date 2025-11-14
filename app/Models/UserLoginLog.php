<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class UserLoginLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'ip_address', 'user_agent',
        'status', 'logged_in_at', 'logged_out_at'
    ];

    protected $casts = [
        'logged_in_at'   => 'datetime',
        'logged_out_at'  => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

