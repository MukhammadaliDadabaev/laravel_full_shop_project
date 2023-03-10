<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFiltersRequest;
use App\Http\Requests\SubscriptionRequest;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Product;
use App\Models\Subscription;
use Illuminate\Support\Facades\App;

class MainController extends Controller
{
  public function index(ProductFiltersRequest $request)
  {
    // Log::info($request->ip());
    // \Debugbar::info($request);
    //-----> PRODUCT-FILTERS
    $productsQuery = Product::query();

    if ($request->filled('price_from')) {
      $productsQuery->where('price', '>=', $request->price_from);
    }

    if ($request->filled('price_to')) {
      $productsQuery->where('price', '<=', $request->price_to);
    }

    foreach (['hit', 'new', 'recommend'] as $field) {
      if ($request->has($field)) {
        $productsQuery->$field();
      }
    }

    $products = $productsQuery->paginate(6)->withPath("?" . $request->getQueryString());
    return view('index', compact('products'));
  }

  public function categories()
  {
    $categories = Category::get();
    return view('categories', compact('categories'));
  }

  public function category($code)
  {
    $category = Category::where('code', $code)->first();
    return view('category', compact('category'));
  }

  public function product($category, $productCode)
  {
    $product = Product::withTrashed()->byCode($productCode)->firstOrFail();
    return view('product', compact('product'));
  }

  public function subscribe(SubscriptionRequest $request, Product $product)
  {
    // dd($product);
    Subscription::create([
      'email' => $request->email,
      'product_id' => $product->id,
    ]);

    return redirect()->back()->with('success', 'product.we_will_update...😎');
  }

  public function changeLocale($locale)
  {
    $availableLocales = ['en', 'ru', 'uz'];
    if (!in_array($locale, $availableLocales)) {
      $locale = config('app.locale');
    }
    session(['locale' => $locale]);
    App::setLocale($locale);

    return redirect()->back();
  }

  public function changeCurrency($currencyCode)
  {
    $currency = Currency::byCode($currencyCode)->firstOrFail();
    session(['currency', $currency->code]);

    return redirect()->back();
  }
}