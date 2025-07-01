<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [
        'user_id',
        'join_date',
        'days_in_team',
        'kills',
        'deaths',
        'online',
        'clan_role',
        'kick_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
