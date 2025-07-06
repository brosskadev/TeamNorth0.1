<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
protected $fillable = [
    'personnel_number',
    'user_id',
    'steam_id',
    'specialization',
    'brigade',
    'join_date',
    'days_in_team',
    'days_recruit',
    'days_prospect',
    'days_main',
    'kills',
    'deaths',
    'on_holiday',
    'clan_role',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
