<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    protected $fillable = ['address', 'city', 'province', 'country', 'customer_id'];

    // Shipping Model
    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'shipping_id', 'id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
