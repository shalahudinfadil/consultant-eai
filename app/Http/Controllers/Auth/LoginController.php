<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JD\Cloudder\Facades\Cloudder;

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
            $user = User::where('eid',Auth::user()->eid)->first();
            $user->last_login = Carbon::now()->toDateTimeString();
            $user->save();

            return redirect('/overview');
          }
        }
        return redirect('/')->with('status','oioi');
      } else {
        return redirect('/')->withError('Invalid EID or Password!');
      }
    }

    public function logout()
    {
      Auth::logout();
      return redirect('/');
    }

    public function promptPassword(Request $req)
    {
      $pass = $req->newpassword;
      $validated = $req->validate([
        'newpassword' => 'required|min:8',
        'confirmpassword' => 'required|min:8|in:'.$pass,
      ]);

      $user = User::where('eid',Auth::user()->eid)->first();
      $user->password = bcrypt($req->confirmpassword);
      $user->last_login = Carbon::now()->toDateTimeString();
      $user->save();

      return redirect('/overview');
    }

    public function uploadImages(Request $request)
   {
       $this->validate($request,[
           'image_name'=>'required|mimes:jpeg,bmp,jpg,png|between:1, 6000',
       ]);

       $image_name = $request->file('image_name')->getRealPath();;

       Cloudder::upload($image_name, 'img1');

       return redirect()->back()->withSuccess('Image Uploaded Successfully');

   }

   public function show()
   {
     return Cloudder::secureShow('img1');
   }

}
