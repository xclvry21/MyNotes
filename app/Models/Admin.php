<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image'
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
    ];


    public function admin_create($data)
    {
        return DB::table('admins')
            ->insert([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'profile_image' => $data['profile_image_name'],
                'created_at' => date('Y-m-d H:i:s')
            ]);
    }

    public function admin_update($data, $id)
    {
        return DB::table('admins')
            ->where('id', '=', $id)
            ->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'profile_image' => $data['profile_image_name'],
                'updated_at' => date('Y-m-d H:i:s')
            ]);
    }
}
