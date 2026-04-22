<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'types';

    protected $fillable = [
        'name',
        'code'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
