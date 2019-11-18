<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Str;
use Validator;

use App\Pic;

class AuthController extends Controller
{
    public function register(Request $req)
    {
      $validated = Validator::make($req->all(), [
        'email' => 'required|unique:pics,email|email:rfc',
        'name' => 'required',
        'password' => 'required|min:8',
        'confirmpassword' => 'required|min:8|in:'.$req->password,
        'client_id' => 'required|exists:clients,id',
      ]);

      if ($validated->fails()) {
        return response()->json(['message' => $validated->errors()], 401);
      } else {
        $pic = Pic::create([
          'name' => $req->name,
          'email' => $req->email,
          'password' => bcrypt($req->confirmpassword),
          'client_id' => $req->client_id,
          'token' => Str::random(40),
        ]);

        return response()->json(['message' => 'Successfully Register'], 200);
      }

    }

    public function login(Request $req)
    {
      $validated = Validator::make($req->all(),[
        'email' => 'required|exists:pics,email',
        'password' => 'required',
      ]);

      if ($validated->fails()) {
        return response()->json(['message' => $validated->errors()], 404);
      }

      $pic = Pic::where('email',$req->email)->first();
      if (password_verify($req->password,$pic->password)) {
        if ($pic->verified == null) {
          return response()->json(['message' => 'You haven\'t verified your Email'], 403);
        } elseif ($pic->approved_at == null) {
          return response()->json(['message' => 'Your account hasn\'t been approved by Administrator'], 403);
        } else {
          return response()->json(['message' => 'Successfully Login', "account" => $pic->only(['email','name','token','client_id'])], 200);
        }
      } else {
        return response()->json(['message' => 'Password Error'], 403);
      }
    }
}
