<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;
    
    protected $attributes = [
        'status' => 'Ongoing',
    ];
    
    public function transactionHeader(){
        return $this->belongsTo(TransactionHeader::class);
    }
    
    public function service(){
        return $this->belongsTo(Service::class);
    }
}
