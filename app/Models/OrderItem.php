<?php

namespace App\Models;

use App\Models\Scopes\NotDeletedScope;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['OrderId', 'ProductId', 'UnitPrice', 'Quantity'];

    protected static function booted()
    {
        static::addGlobalScope(new NotDeletedScope);
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'OrderId');
    }

    public function Product()
    {
        return $this->belongsTo(Product::class, 'ProductId');
    }
}
