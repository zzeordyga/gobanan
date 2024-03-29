<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $attributes = [
        'times_visited' => 0,
    ];
    
    public function services(){
        return $this->hasMany(Service::class);
    }
}
