<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    // OJO: que se puede llenar el ROL
    public $incrementing = false;
    protected $fillable = [
        'name', 'rol', 'fechaInicio', 'fechaFin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public static function getUserByEmail($email){

        return DB::table('users')                    
                    ->select('*')
                    ->where('id', $email)
                    ->get();
    }
}
