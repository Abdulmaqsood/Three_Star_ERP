<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Customer extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'title',
        'quickbook_id',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'suffix',
        'company',
        'display_name',
        'phone_number',
        'mobile_number',
        'fax',
        'other',
        'website',
        'cheque_print_name',
        'terms',
        'business_number',
        'payment_method_id',
        'image',
        'password',
    ];
 /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function address()
    {
        return $this->hasOne(Address::class);
    }
    public function payment_method()
    {
        return $this->hasOne(PaymentMethod::class,'id','payment_method_id');
    }
    // public function customerProducts()
    // {
    //     return $this->hasMany(CustomerProduct::class);
    // }
    public function products()
    {
        return $this->belongsToMany(Product::class,'customer_products')->withTimestamps();
    }
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
    public function shipping()
    {
        return $this->hasOne(Shipping::class);
    }





    public static function getCustomerCount()
    {
        return self::count();
    }
}
