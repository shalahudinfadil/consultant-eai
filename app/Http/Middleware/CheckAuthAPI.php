<?php

namespace App\Http\Middleware;

use Closure;
use Validator;

use App\Pic;

class CheckAuthAPI
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      if ($request->isMethod('post')) {
        $validator = Validator::make($request->only(['token','id']),[
          'token' => 'required|exists:pics,token',
          'id' => 'required|exists:pics,id',
        ]);

        if ($validator->fails()) {
          return response()->json(['message' => $validator->errors()], 403);
        }

        $pic = Pic::find($request->id);

        if ($pic->verified && $pic->approved_at != null && $request->token == $pic->token) {
          return $next($request);
        } else {
          return response()->json(['message' => 'You\'re not authorized to access this API'], 403);
        }
      } else {
        return response()->json(['message' => 'All endpoints uses POST method'], 405);
      }
    }
}
