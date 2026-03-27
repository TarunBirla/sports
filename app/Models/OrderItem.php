<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Course;
use App\Models\Order;


class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'type',
        'item_id',
        'price',
        'qty'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'item_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'item_id');
    }


    public function order()
    {
        return $this->belongsTo(Order::class);
    }


}
