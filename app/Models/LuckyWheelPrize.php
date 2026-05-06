<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LuckyWheelPrize extends Model
{
    protected $fillable = ['label', 'prize_type', 'prize_value', 'probability', 'color', 'status'];
}
