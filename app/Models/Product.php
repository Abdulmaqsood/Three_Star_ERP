<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['sku','quickbook_id','name','type','description','cost','price','profit','sub_category_id','category_id','vendor_id','manufacturer_id','image' , 'vendor_code' , 'manufacturer_code','pack'];
  
    
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class,'sub_category_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }
    // public function customerProduct()
    // {
    //     return $this->hasMany(CustomerProduct::class);
    // }
    public function customers()
    {
        return $this->belongsToMany(Customer::class,'customer_products')->withTimestamps(); ;
    }


    public static function getProductCount()
    {
        return self::count();
    }
}
