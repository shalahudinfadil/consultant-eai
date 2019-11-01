<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modul;
use App\Submodul;
use App\Ticket;
use App\Client;

class APIController extends Controller
{
    public $success = 200;

    public function getModules($modul_id = null)
    {
      $data = ($modul_id != null) ? Modul::where('id',$modul_id)->with('submoduls')->get() : Modul::with('submoduls')->get();

      return response()->json(['data' => $data, 'status' => $this->success]);
    }

    public function getSubmodules($submodul_id = null)
    {
      $data = ($submodul_id != null) ? Submodul::where('id',$submodul_id)->get() : Submodul::all();

      return response()->json(['data' => $data, 'status' => $this->success]);
    }

    public function getClients($client_id = null)
    {
      $data = ($client_id != null) ? Client::where('id',$client_id)->get() : Client::all();

      return response()->json(['data' => $data, 'status' => $this->success]);
    }

}
