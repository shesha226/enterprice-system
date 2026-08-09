<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'UserId';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
    ];

    protected $hidden = [
        'Password',
        'remember_token',
    ];


    public function getAuthPassword()
    {
        return $this->Password;
    }

    protected function casts(): array
    {
        return [
            'Password' => 'hashed',
        ];
    }
}
