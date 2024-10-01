<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = ['method', 'description'];
    public function user()
    {
        return $this->belongsTo(Customer::class,'id','payment_method_id');
    }
}
