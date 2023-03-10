<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  use HasFactory;

  protected $fillable = [
    'status',
    'name',
    'phone',
    'user_id',
    'currency_id',
    'sum',
  ];

  public function products()
  {
    return $this->belongsToMany(Product::class)->withPivot(['count', 'price'])->withTimestamps();
  }

  // public function skus()
  // {
  //     return $this->belongsToMany(Sku::class)->withPivot(['count', 'price'])->withTimestamps();
  // }

  // public function currency()
  // {
  //     return $this->belongsTo(Currency::class);
  // }

  // public function coupon()
  // {
  //     return $this->belongsTo(Coupon::class);
  // }

  public function scopeActive($query)
  {
    return $query->where('status', 1);
  }

  // public function user()
  // {
  //     return $this->belongsTo(User::class);
  // }

  public function calculateFullSum()
  {
    $sum = 0;
    foreach ($this->products()->withTrashed()->get() as $product) {
      $sum += $product->getPriceForCount();
    }
    return $sum;
  }

  public static function eraseOrderSum()
  {
    session()->forget('full_order_sum');
  }

  public static function getFullSum()
  {
    $sum = 1;
    return $sum;
  }

  public function saveOrder($name, $phone)
  {
    if ($this->status == 0) {
      $this->name = $name;
      $this->phone = $phone;
      $this->status = 1;
      // $this->sum = $this->getFullSum();

      // $skus = $this->skus;
      $this->save();
      session()->forget('orderId');
      return true;
    } else {
      return false;
    }
    // foreach ($skus as $skuInOrder) {
    //     $this->skus()->attach($skuInOrder, [
    //         'count' => $skuInOrder->countInOrder,
    //         'price' => $skuInOrder->price,
    //     ]);
    // }

    // session()->forget('order');
    // return true;
  }
}
