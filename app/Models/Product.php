<?php

namespace App\Models;

use App\Models\Scopes\NotDeletedScope;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['ProductName', 'SupplierId', 'UnitPrice'];

    protected static function booted()
    {
        static::addGlobalScope(new NotDeletedScope);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'SupplierId');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'ProductId');
    }
}
