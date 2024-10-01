<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $fillable = ['name','email','address','image'];
    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
