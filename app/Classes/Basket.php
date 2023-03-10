<?php

namespace App\Classes;

// use App\Mail\OrderCreated;
// use App\Models\Coupon;

use App\Mail\OrderCreated;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

// use App\Models\Sku;
// use App\Services\CurrencyConversion;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Mail;

class Basket
{
  protected $order;

  /**
   * Basket constructor.
   * @param  bool  $createOrder
   */
  public function __construct($createOrder = false)
  {
    $order = session('order');

    if (is_null($order) && $createOrder) {
      // User olgan tovar-ni korzinaga saqlash
      $data = [];
      if (Auth::check()) {
        $data['user_id'] = Auth::id();
      }

      $this->order = Order::create($data);
      session(['orderId' => $this->order]);
    } else {
      $this->order = $order;
    }
  }

  /**
   * @return mixed
   */
  public function getOrder()
  {
    return $this->order;
  }

  public function countAvailable($updateCount = false)
  {
    // $skus = collect([]);
    // foreach ($this->order->skus as $orderSku) {
    //     $sku = Sku::find($orderSku->id);
    //     if ($orderSku->countInOrder > $sku->count) {
    //         return false;
    //     }

    //     if ($updateCount) {
    //         $sku->count -= $orderSku->countInOrder;
    //         $skus->push($sku);
    //     }
    // }

    // if ($updateCount) {
    //     $skus->map->save();
    // }

    // return true;
  }

  public function countAvalible($updateCount = false)
  {
    foreach ($this->order->products as $orderProduct) {
      if ($orderProduct->count < $this->getPivotRow($orderProduct)->count) {
        return false;
      }

      if ($updateCount) {
        $orderProduct->count -= $this->getPivotRow($orderProduct)->count;
      }
    }

    if ($updateCount) {
      $this->order->products->map->save();
    }

    return true;
  }

  public function saveOrder($name, $phone, $email)
  {
    if (!$this->countAvalible(true)) {
      return false;
    }
    // if (!$this->countAvailable(true)) {
    //     return false;
    // }
    // $this->order->saveOrder($name, $phone);
    Mail::to($email)->send(new OrderCreated($name, $this->getOrder()));
    // return true;
    return $this->order->saveOrder($name, $phone);
  }

  public function getPivotRow($product)
  {
    return $this->order->products()->where('product_id', $product->id)->first()->pivot;
  }

  public function removProduct(Product $product)
  {

    if ($this->order->products->contains($product->id)) {
      $pivotRow = $this->getPivotRow($product);
      if ($pivotRow->count < 2) {
        $this->order->products()->detach($product->id);
      } else {
        $pivotRow->count--;
        $pivotRow->update();
      }
    }

    Order::changeFullSum(-$product->price);
  }

  public function addProduct(Product $product)
  {

    if ($this->order->products->contains($product->id)) {
      $pivotRow = $this->getPivotRow($product);
      $pivotRow->count++;

      if ($pivotRow->count > $product->count) {
        return false;
      }
      $pivotRow->update();
    } else {
      if ($product->count == 0) {
        return false;
      }

      $this->order->products->push($product);
    }

    return true;
  }
  // public function removeSku(Sku $sku)
  // {
  //     if ($this->order->skus->contains($sku)) {
  //         $pivotRow = $this->order->skus->where('id', $sku->id)->first();
  //         if ($pivotRow->countInOrder < 2) {
  //             $this->order->skus->pop($sku);
  //         } else {
  //             $pivotRow->countInOrder--;
  //         }
  //     }
  // }

  // public function addSku(Sku $sku)
  // {
  //     if ($this->order->skus->contains($sku)) {
  //         $pivotRow = $this->order->skus->where('id', $sku->id)->first();
  //         if ($pivotRow->countInOrder >= $sku->count) {
  //             return false;
  //         }
  //         $pivotRow->countInOrder++;
  //     } else {
  //         if ($sku->count == 0) {
  //             return false;
  //         }
  //         $sku->countInOrder = 1;
  //         $this->order->skus->push($sku);
  //     }

  //     return true;
  // }

  // public function setCoupon(Coupon $coupon)
  // {
  //     $this->order->coupon()->associate($coupon);
  // }

  // public function clearCoupon()
  // {
  //     $this->order->coupon()->dissociate();
  // }
}
