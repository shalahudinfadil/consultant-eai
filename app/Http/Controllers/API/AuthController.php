<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;
use Validator;

use App\Pic;

class AuthController extends Controller
{
    public $status = 200;

    // public function register(Request $req)
    // {
    //   $validated = Validator::make($req->all(), [
    //     'email' => 'required|email:rfc',
    //     'name' => 'required',
    //     'password' => 'required|min:8',
    //     'confirmpassword' => 'required|min:8|in:'.$req->password,
    //     'client_id' => 'required|exists:clients,id',
    //   ]);
    //
    //   if ($validated->fails()) {
    //     return response()->json(['error' => $validated->errors()], 401);
    //   } else {
    //     $input = $req->all();
    //     $input['password'] = bcrypt($req->confirmpassword);
    //     $pic = Pic::create($input);
    //
    //     $token = $pic->createToken('TicketPIC')->accessToken;
    //
    //     return response()->json(['token' => $token], 200);
    //   }
    //
    // }
    //
    // public function login()
    // {
    //   if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
    //     $pic = Auth::user();
    //     $token = $pic->createToken('TicketPIC')->accessToken;
    //
    //     return response()->json(['token' => $token], 200);
    //   } else {
    //     return response()->json(['error' => 'Unauthorized'], 401);
    //   }
    // }
}
