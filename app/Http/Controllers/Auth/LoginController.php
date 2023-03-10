<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{

  protected $redirectTo = '/home';
  protected function redirectTo()
  {
    if (Auth::user()->isAdmin()) {
      return route('home');
    } else {
      return route('person.orders.index');
    }
  }

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest')->except('get-logout');
  }

  public function create()
  {
    return view('auth.login');
  }

  public function store(Request $request)
  {
    $credentials = $request->validate([
      // 'name' => ['required', 'string'],
      'email' => ['required', 'string', 'email'],
      'password' => ['required', 'string'],
    ]);

    if (!Auth::attempt($credentials, $request->boolean('remember'))) {

      //----------> BU 2-USUL
      throw ValidationException::withMessages([
        'email' => trans('auth.failed')
      ]);
    }

    // $request->session->regenerate();

    return redirect()->intended(RouteServiceProvider::HOME);
  }

  public function destroy(Request $request)
  {
    //Auth::logout();
    //$request->session->invalidate();
    //$request->session->regenerateToken();
    //return redirect()->route('home');

    if (Auth::user()->isAdmin()) {
      return route('home');
    } else {
      return route('index');
    }
  }
}