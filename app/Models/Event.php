<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $primaryKey = 'event_id';

    public function registrations(){
        return $this->hasMany(Registration::class, 'reg_id');
    }

    public function category(){
        return $this->belongsTo(Category::Class, 'cat_id');
    }
}
