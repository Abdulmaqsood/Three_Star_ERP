<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerProduct extends Model
{
    use HasFactory;
    protected $fillable = ['assign_price','product_id','customer_id','profit','quantity'];
    // public function user()
    // {
    //     return $this->belongsTo(Customer::class,'customer_id');
    // }
    // public function product()
    // {
    //     return $this->belongsTo(Product::class);
    // }
}
