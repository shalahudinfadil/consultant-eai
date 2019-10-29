<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Assignment;
use App\Modul;
use App\Submodul;
use App\Ticket;

class ConsultantController extends Controller
{

    public function index()
    {
      $members = User::consultant()
                  ->whereNotIn('eid',[Auth::user()->eid])
                  ->whereHas('assignments', function($q){
                      $q->where('submodul_id',Auth::user()->assignments->submodul_id);
                    })
                  ->get();



      return view('consultant.overview', compact('members'));
    }

    //Ticket - START

    public function ticketIndex()
    {
      $tickets = Ticket::OfSubmodule(Auth::user()->assignments->submodul_id)
                          ->with('clients')
                          ->orderBy('created_at','desc')
                          ->get();

      return view('consultant.ticket', compact('tickets'));
    }

    public function ticketView($id)
    {
      $ticket = Ticket::find($id);

      return view('consultant.ticket.view', compact('ticket'));
    }

    //Ticket - END
}
