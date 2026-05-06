<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WithdrawalAccount extends Model
{
    protected $fillable = ['user_id', 'label', 'country', 'operator', 'phone'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCountryNameAttribute(): string
    {
        $names = [
            'CM' => 'Cameroun',
            'CI' => "Côte d'Ivoire",
            'BJ' => 'Bénin',
            'BF' => 'Burkina Faso',
            'TG' => 'Togo',
        ];
        return $names[$this->country] ?? $this->country;
    }

    public function getFlagAttribute(): string
    {
        $flags = ['CM' => '🇨🇲', 'CI' => '🇨🇮', 'BJ' => '🇧🇯', 'BF' => '🇧🇫', 'TG' => '🇹🇬'];
        return $flags[$this->country] ?? '';
    }
}
