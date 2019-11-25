<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyMail;
use Validator;

use App\Pic;
use App\Client;

class AuthController extends Controller
{

    public function getClients()
    {
      $data = Client::all();

      return response()->json(['data' => $data], 200);
    }

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

        $data = [
          'name' => $pic->name,
          'email' => $pic->email,
          'url' => url("/api/verify?v=".$pic->token),
        ];

        Mail::to($req->email)->send(new VerifyMail($data));

        return response()->json(['message' => 'Successfully Register','code' => 200]);
      }
    }

    public function verifyEmail(Request $request)
    {
      $status = 0;
      try {
        $pic = Pic::where('token',$request->query('v'))->firstOrFail();
      } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return view('mail.verify')->with('status',$status);
      }
      $pic->verified = 1;
      $pic->save();
      $status = 1;

      return view('mail.verify')->with('status',$status);
    }

    public function login(Request $req)
    {
      $validated = Validator::make($req->all(),[
        'email' => 'required|exists:pics,email',
        'password' => 'required',
      ]);

      if ($validated->fails()) {
        return response()->json(['message' => $validated->errors(), 'code' => 404]);
      }

      $pic = Pic::where('email',$req->email)->with('client')->first();
      if (password_verify($req->password,$pic->password)) {
        if ($pic->verified == null) {
          return response()->json(['message' => 'You haven\'t verified your Email', 'code' => 403]);
        } elseif ($pic->approved_at == null) {
          return response()->json(['message' => 'Your account hasn\'t been approved by Administrator', 'code' => 403]);
        } else {
          return response()->json(['message' => 'Successfully Login', "account" => $pic->only(['id','email','name','token','client_id','client']), 'code' => 200]);
        }
      } else {
        return response()->json(['message' => 'Password Error', 'code' => 403]);
      }
    }
}
