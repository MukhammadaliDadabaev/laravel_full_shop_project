<?php

namespace App\Http\Controllers;

use App\Classes\Basket;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
  public function basket()
  {
    $order = (new Basket())->getOrder();

    return view('basket', compact('order'));
  }

  // TAVAR-OLISH
  public function basketConfirm(Request $request)
  {
    $email = Auth::check() ? Auth::user()->email : $request->email;
    if ((new Basket())->saveOrder($request->name, $request->phone, $email)) {
      session()->flash('success', __('basket.you_order_confirmed'));
    } else {
      session()->flash('warning', 'Tovar olishda xatolik...👇,большем кол-ве не дос тавар полно');
    }

    Order::eraseOrderSum();
    return redirect()->route('index');
  }

  // Tavarni Оформить qilish
  public function basketPlace()
  {
    $basket = new Basket();
    $order = $basket->getOrder();

    if (!$basket->countAvalible()) {
      session()->flash('warning', 'Tovar ... большем кол-ве не дос тавар полно обем');
      return redirect()->route('basket');
    }

    return view('order', compact('order'));
  }

  // Tavarni tekshirib korzinkaga qo'shish
  public function basketAdd(Product $product)
  {
    $result = (new Basket(true))->addProduct($product);

    if ($result) {
      session()->flash('success', 'Tovar olindi...👉' . $product->name);
    } else {
      session()->flash('warning', 'Tovar ...👉' . $product->name . ' в большем кол-ве не дос для тавар');
    }

    return redirect()->route('basket');
  }

  public function basketRemove(Product $product)
  {
    (new Basket())->removProduct($product);

    session()->flash('warning', 'Tovar o\'chirildi...❌' . $product->name);
    return redirect()->route('basket');
  }
}
