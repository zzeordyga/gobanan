<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function reviewCount(){
        return $this->reviews()->count();
    }

    public function reviewRating(){
        return $this->reviews()->avg('rating');
    }

    public function user(){
        return $this->belongsTo(User::class)->first();
    }

    public function category(){
        return $this->belongsTo(Category::class)->first();
    }
}
