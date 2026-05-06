<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LuckyWheelSpin extends Model
{
    protected $fillable = ['user_id', 'spins_available', 'total_spins_earned', 'total_spins_used'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
