<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\Rule;

use App\Modul;
use App\Submodul;
use App\Ticket;
use App\Client;
use App\Pic;

class APIController extends Controller
{
    public function __construct()
    {
      $this->middleware('authapi');
    }

    public function getModules()
    {
      $data = Modul::with('submoduls')->get();

      return response()->json(['data' => $data], 200);
    }

    public function getSubmodules($modul_id = null)
    {
      $data = ($modul_id != null) ? Submodul::where('modul_id',$modul_id)->get() : Submodul::all();

      return response()->json(['data' => $data], 200);
    }

    public function getClients($client_id = null)
    {
      $data = ($client_id != null) ? Client::where('id',$client_id)->get() : Client::all();

      return response()->json(['data' => $data], 200);
    }

    public function postTicket(Request $req)
    {
      $validate = Validator::make($req->all(), [
        'modul_id' => 'required|exists:moduls,id',
        'submodul_id' => 'required|exists:submoduls,id',
        'client_id' => 'required|exists:clients,id',
        'PIC' => 'required|exists:pics,id',
        'title' => 'required|max:255',
        'message' => 'required|max:1000',
        'priority' => 'required|between:1,3',
      ]);

      if ($validate->fails()) {
        return response()->json(['error' => $validate->errors()], 400);
      }

      $input = $req->all();
      $input['status'] = 1;
      $ticket = Ticket::create($input);

      return response()->json(['success' => 'Your ticket #'.$ticket->ticketNumber().' has been submitted!'], 200);
    }

    public function getTickets(Request $req)
    {
      $tickets = Ticket::where('pic_id', $req->id)->get()->toArray();

      return response()->json(['data' => $tickets]);
    }

    public function getTicket($id)
    {
      try {
        $ticket = Ticket::where('id',$id)->firstOrFail();
      } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json(['error' => 'Ticket Not Found'], 404);
      }

        return response()->json(['data' => $ticket], 200);
    }

    public function updateInfo(Request $req)
    {
      $validated = Validator::make($req->all(),[
        'email' => 'required',
        'name' => 'required',
      ]);

      if ($validated->fails()) {
        return response()->json(['message' => $validated->errors()], 404);
      }

      $pic = Pic::find($req->id);
      $pic->email = $req->email;
      $pic->name = $req->name;
      $pic->save();

      return response()->json(['message' => 'Info Updated', "account" => $pic->only(['email','name','token','client_id'])]);
    }

}
