<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    use HasFactory;
    protected $fillable = ['name','email','address','city','state','country','postal_code','image','contact_number','website'];


    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
