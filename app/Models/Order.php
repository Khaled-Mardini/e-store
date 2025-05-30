<?php

namespace App\Models;

use App\Models\Scopes\NotDeletedScope;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['OrderDate', 'OrderNumber', 'CustomerId', 'TotalAmount'];

    protected static function booted()
    {
        static::addGlobalScope(new NotDeletedScope);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'CustomerId');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'OrderId');
    }
}
