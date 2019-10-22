<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modul;

class APIController extends Controller
{
    public $success = 200;

    public function getModules($modul_id = null)
    {
      $data = ($modul_id != null) ? Modul::where('id',$modul_id)->with('submoduls')->get() : Modul::with('submoduls')->get();

      return response()->json(['data' => $data, 'status' => $this->success]);
    }
    
}
