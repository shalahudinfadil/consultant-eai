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
    public function __construct()
    {
      $this->middleware('check.login');
    }

    public function index()
    {
      $members = User::consultant()
                  ->whereNotIn('eid',[Auth::user()->eid])
                  ->whereHas('assignments', function($q){
                      $q->where('submodul_id',Auth::user()->assignments->submodul_id);
                    })
                  ->get();

      $tickets = Ticket::OfSubmodule(Auth::user()->assignments->submodul_id)
                          ->with('clients')
                          ->orderBy('created_at','desc')
                          ->get();

      return view('consultant.home', compact('members'))->with('tickets',$tickets);
    }
}
