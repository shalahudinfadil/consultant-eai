<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
      $credentials = $request->only('eid','password');

      if (Auth::attempt($credentials)) {
        if (Auth::user()->role_id == 1) {
          return redirect('/dashboard');
        } else {
          return redirect('home');
        }
      } else {
        return redirect('/')->with('status','Invalid EID or Password!');
      }
    }

    public function logout()
    {
      Auth::logout();
      return redirect('/');
    }

}
