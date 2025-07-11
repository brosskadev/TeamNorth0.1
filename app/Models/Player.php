<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Player extends Model
{
    protected $primaryKey = 'id'; // автоинкрементное поле
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'player_id',
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
        'role_changed_at',
    ];

    protected $casts = [
    'role_changed_at' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function daysOnCurrentRole(): int
{
    if (!$this->role_changed_at || !$this->clan_role) {
        return 0;
    }

    $role = mb_strtolower($this->clan_role);

    if ($role === 'новобранец') {
        return Carbon::parse($this->role_changed_at)->diffInDays(now());
    }

    if ($role === 'проспект') {
        return Carbon::parse($this->role_changed_at)->diffInDays(now());
    }

    if ($role === 'основа') {
        return Carbon::parse($this->role_changed_at)->diffInDays(now());
    }

    return 0;
}
    
}


