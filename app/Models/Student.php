<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // Tell laravel this is the name of the primary key (Laravel will think id is the primary key if not inidcated)
    protected $primaryKey = 'stud_id';

    public function registrations(){
        return $this->hasMany(Registration::class, 'reg_id');
    }

}
