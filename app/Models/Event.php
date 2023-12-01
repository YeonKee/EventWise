<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $primaryKey = 'event_id';

    protected $fillable = [
        'description',
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'reg_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::Class, 'cat_id');
    }

    // public function calcCapacity()
    // {
    //     $event_capacity = $this->capacity;
    //     $total = 0;

    //     foreach ($event_capacity as $cap) {
    //         $availableCap += $cap->calcCap();
    //     }

    //     return $total;
    // }

    public function calcCapacity()
    {
        $totalCapacity = $this->capacity;
        $participatedCount = $this->participated_count;
    
        $remainingCapacity = max(0, $totalCapacity - $participatedCount);
    
        return $remainingCapacity;
    }
    


}
