<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    // shop
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    // products
    public function products()
    {
        return $this->hasMany(InvoiceItem::class)->with('product');
    }
}
