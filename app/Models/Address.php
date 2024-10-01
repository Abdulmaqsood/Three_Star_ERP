<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = ['address_1', 'address_2', 'city', 'province', 'postal_code', 'country', 'user_id'];
    public function user()
    {
        return $this->belongsTo(Customer::class);
    }
}
