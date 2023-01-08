<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'product_name',
        'price',
        'orders',
        'tax_rate',
        'tax',
        'subtotal',
        'shipping_charge',
        'total',
        'payment',
        'name',
        'postcode',
        'prefecture_id',
        'address',
        'building',
        'tel',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class);
    }

    /**
     * 計算
     *
     * @param Prefecture $prefecture
     * @param Product $product
     * @param integer $orders
     * @param integer $tax_rate
     * @return array
     */
    public function calc(Prefecture $prefecture, Product $product, int $orders, int $tax_rate) : array
    {
        $tax_rate = config('tax.rate');
        $tax = ceil($product->price * $orders * ($tax_rate) / 100);
        $subtotal = $product->price * $orders + $tax;
        $total = $subtotal + $prefecture->shipping_charge;
        return [
            'product_id' => $product->id,
            'product_name' => $product->name,
            'prefecture_id' => $prefecture->id,
            'shipping_charge' => $prefecture->shipping_charge,
            'price' => $product->price,
            'orders' => $orders,
            'tax_rate' => $tax_rate,
            'tax' => $tax,
            'subtotal' => $subtotal,
            'total' => $total,
        ];
    }
}
