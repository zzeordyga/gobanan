<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHeader extends Model
{
    use HasFactory;

    protected $attributes = [
        'payment_type' => 'Payment Pending',
    ];

    public function details(){
        return $this->hasMany(TransactionDetail::class);
    }

    public function user(){
        return $this->belongsTo(User::class)->first();
    }
}
