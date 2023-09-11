<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;

    // Tell laravel this is the name of the primary key (Laravel will think id is the primary key if not inidcated)
    protected $primaryKey = 'stud_id';

    public function registrations(){
        return $this->hasMany(Registration::class, 'reg_id');
    }

}
