<?php

namespace App\Models\Student;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class student extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'students';

    protected $fillable = ['name','email','password','confirmed','verify_account'];

    protected $hidden = ['password','remember_token', 'verify_account','confirmed'];

    protected $guarded = ['student'];

    // Rest omitted for brevity

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

    public function comments(){

        return $this->hasMany('\App\Models\Comments\comment');
    }
}
