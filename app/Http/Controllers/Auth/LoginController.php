<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
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
          if (Auth::user()->last_login == null) {
            return redirect('/promptpassword');
          } else {
            $user = User::where('eid',Auth::user()->eid)->get();
            $user->last_login = Carbon::now()->toDateTimeString();
            $user->save();

            return redirect('/home');
          }
        }
        return redirect('/')->with('status','oioi');
      } else {
        return redirect('/')->with('status','Invalid EID or Password!');
      }
    }

    public function logout()
    {
      Auth::logout();
      return redirect('/');
    }

    public function promptPassword(Request $req)
    {
      $user = User::where('eid',Auth::user()->eid)->first();
      $user->password = bcrypt($req->password);
      $user->last_login = Carbon::now()->toDateTimeString();
      $user->save();

      return redirect('/home');
    }

}
