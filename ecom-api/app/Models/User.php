<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'user_type',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'address',
        'city',
        'state',
        'pincode',
        'billing_address',
        'billing_city',
        'billing_state',
        'billing_pincode'
    ];
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'email' => 'string',
        'password' => 'string',
        'user_type' => 'string',
        'first_name' => 'string',
        'middle_name' => 'string',
        'last_name' => 'string',
        'gender' => 'string',
        'address' => 'string',
        'city' => 'string',
        'state' => 'string',
        'pincode' => 'integer',
        'billing_address' => 'string',
        'billing_city' => 'string',
        'billing_state' => 'string',
        'billing_pincode' => 'string'
    ];
}
