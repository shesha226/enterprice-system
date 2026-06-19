<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // 1. Primary Key එක 'id' නෙවෙයි 'UserId' කියලා Laravel එකට කියන්න
    protected $primaryKey = 'UserId';

    // 2. Postman එකෙන් එවන නිවැරදි කැපිටල් අකුරු සහිත නම් ටික මෙතනට දාන්න
    protected $fillable = [
        'UserId',
        'Name',
        'Role',
        'Password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'Password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'Password' => 'hashed',
        ];
    }
}
