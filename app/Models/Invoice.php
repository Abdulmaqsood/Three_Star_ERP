<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Invoice extends Model
{
    use HasFactory;
      protected $fillable = ['invoice_number','quickbook_id','sub_total','total','tax','description','customer_id','shipping_address','shipping_city','shipping_country'];

 
    public function items(){
        return $this->hasMany(InvoiceItem::class);
    }
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public function shipping()
    {
        return $this->hasOne(Shipping::class, 'id', 'shipping_id');
    }








    // createda at functionlaity
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    // delete correspnding entries
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($invoice) {
            // Delete related items
            $invoice->items()->delete();
        });
    }

     // Method to calculate the total amount of all invoices
     public static function getTotalInvoicesAmount()
     {
         return self::sum('total');
     }

      // Method to get monthly sales totals for the current year
    public static function getMonthlySales()
    {
        return self::select(
                DB::raw('SUM(total) as total_sales'),
                DB::raw('MONTH(created_at) as month')
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();
    }
}
