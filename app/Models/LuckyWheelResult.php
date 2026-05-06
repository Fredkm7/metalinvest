<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LuckyWheelResult extends Model
{
    protected $fillable = ['user_id', 'prize_id', 'prize_label', 'prize_value', 'prize_type', 'credited'];
}
