<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
    use Notifiable;

    // Tell laravel this is the name of the primary key (Laravel will think id is the primary key if not inidcated)
    protected $primaryKey = 'stud_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function registrations(){
        return $this->hasMany(Registration::class, 'reg_id');
    }

    public function emailExist($email){
        return Student::where('email', $email);
    }

}
