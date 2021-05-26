<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Auth;



class User extends Authenticatable implements JWTSubject
{
    use HasFactory,
        Notifiable;

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * relationships
     */
    //get relationship of reports to user
    public function reports()
    {
        return $this->morphToMany(Report::class, 'reportable');
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }



    /**
     * functions or operation
     */
}
