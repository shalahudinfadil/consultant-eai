<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\User;
use App\Assignment;
use App\Modul;
use App\Submodul;
use App\Ticket;
use App\Client;
use App\StatusChange;

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

    //Chart Stuff - START

    public function getChartData()
    {
      $tickets = Ticket::OfSubmodule(Auth::user()->assignments->submodul_id)->get();
      $clients = Client::whereIn('id',$tickets->pluck('client_id')->toArray())->get();

      $ticketClientStatus = [
        "label" => ["Open", "Working", "Closed"]
      ];

      foreach ($clients as $key => $client) {
        $ticketClientStatus['labels'][] = $client->name;
        $filtered = $tickets->where('client_id',$client->id)->groupby('status');
        foreach (range(1,3) as $counter) {
          $ticketClientStatus['data'][$counter][] =
            (!empty($filtered[$counter])) ? $filtered[$counter]->count() : 0;
        }
      }

      $ticketWeekStatus = [
        "label" => ["Open", "Working", "Closed"]
      ];

      $startOfWeek = Carbon::now()->startOfWeek()->toDateTimeString();
      $endOfWeek = Carbon::now()->endOfWeek()->toDateTimeString();

      $ticketWeekStatus['labels'] = $this->getDatesInWeek();
      foreach ($ticketWeekStatus['labels'] as $key => $date) {
        $tickets_week = Ticket::OfSubmodule(Auth::user()->assignments->submodul_id)
                              ->whereDate('created_at',Carbon::create($date)->toDateTimeString())
                              ->get();
        $filtered = $tickets_week->groupby('status');
        foreach (range(1,3) as $counter) {
          $ticketWeekStatus['data'][$counter][] =
            (!empty($filtered[$counter])) ? $filtered[$counter]->count() : 0;
        }
      }

      $chartArray = [
        $ticketClientStatus,
        $ticketWeekStatus,
      ];

      return $chartArray;
    }

    public function getDatesInWeek()
    {
      $dates = [];

      for ($date = Carbon::now()->startOfWeek(); $date->lte(Carbon::now()->endOfWeek()->subDays(1)); $date->addDays()) {
        $dates[] = $date->format('D, d F Y');
      }

      return $dates;
    }

    //Chart Stuff - END

    //Activity Feed - START

    public function getActivityFeed()
    {
      $statuses = StatusChange::where('submodul_id',Auth::user()->assignments->submodul_id)
                              ->orderBy('created_at','desc')
                              ->take(20)
                              ->get();
      $html = '';
      foreach ($statuses as $key => $status) {
        $html .= '
        <li class="list-group-item">
          <small>
            '.$status->feed().'
          </small>
        </li>
        ';
      }
      return $html;
    }

    //Activity Feed - END

    //Ticket - START

    public function ticketIndex()
    {
      $tickets = Ticket::OfSubmodule(Auth::user()->assignments->submodul_id)
                          ->with('clients')
                          ->with('pics')
                          ->orderBy('created_at','desc')
                          ->get();

      return view('consultant.ticket', compact('tickets'));
    }

    public function ticketView($id)
    {
      $ticket = Ticket::find($id);

      return view('consultant.ticket.view', compact('ticket'));
    }

    public function ticketChangeStatus($ticket_id)
    {
      $ticket = Ticket::find($ticket_id);

      switch ($ticket->status) {
        case 1 :
          $ticket->status = 2;
          $ticket->working_at = Carbon::now()->toDateTimeString();
          break;
        case 2 :
          $ticket->status = 3;
          $ticket->closing_at = Carbon::now()->toDateTimeString();
          break;
      }

      $ticket->save();

      StatusChange::create([
        'user_eid' => Auth::user()->eid,
        'ticket_id' => $ticket_id,
        'changed_to' => $ticket->status,
        'submodul_id' => $ticket->submodul_id,
      ]);

      return redirect()->back()->withSuccess('Ticket status has been changed to '.$ticket->status());
    }

    //Ticket - END

    //Settings - START

    public function settingsUpdateProfile(Request $req, $eid)
    {
      User::where('eid',$eid)->update([
        'name' => $req->name,
      ]);

      return redirect()->back()->withSuccess('Profile successfully updated!');
    }

    public function settingsChangePassword(Request $req, $eid)
    {
      $validated = $req->validate([
        'newpassword' => 'required|min:8',
        'confirmpassword' => 'required|min:8|in:'.$req->newpassword,
      ]);

      User::where('eid',$eid)->update([
        'password' => bcrypt($req->confirmpassword),
      ]);

      return redirect()->back()->withSuccess('Password has been changed!');
    }

    //Settings - END
}
