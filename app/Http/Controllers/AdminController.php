<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApprovedMail;
use App\User;
use App\Modul;
use App\Submodul;
use App\Client;
use App\Role;
use App\Assignment;
use App\Ticket;
use App\Pic;

class AdminController extends Controller
{

    public function dashboard()
    {
      $ticket = Ticket::all();
      return view('admin.dashboard', compact('ticket'));
    }

    //chart ajax - START

    public function getChartData()
    {
      $moduls = Modul::all();
      $submoduls = Submodul::all();
      $tickets = Ticket::all();
      $clients = Client::all();

      $ticketModule = [];
      foreach ($moduls as $modul) {
        $ticketModule['labels'][] = $modul->id;
        $ticketModule['data'][] = $tickets->groupby('modul_id')[$modul->id]->count();
      }


      $ticketPriority = [
        'labels' => ["Low","Medium","High"],
      ];

      $ticketStatus = [
        'labels' => ['Open','Working','Closed'],
      ];

      $ticketClientPriority = [
        'label' => ["Low", "Medium", "High"],
      ];

      foreach (range(1,3) as $counter) {
        $ticketPriority['data'][] = $tickets->groupby('priority')[$counter]->count();
        $ticketStatus['data'][] = $tickets->groupby('status')[$counter]->count();
      }

      foreach($moduls as $modul) {
        $ticketClientModule['label'][] = $modul->name;
      }

      foreach ($clients as $key => $client) {
        $ticketClientModule['labels'][] = $client->name;
        $ticketClientPriority['labels'][] = $client->name;
        $filtered = $tickets->groupby('client_id')[++$key];
        foreach (range(1,3) as $counter) {
          $ticketClientModule['data'][$counter][] =
            (!empty($filtered->groupby('status')[$counter])) ? $filtered->groupby('status')[$counter]->count() : 0;
          $ticketClientPriority['data'][$counter][] =
            (!empty($filtered->groupby('priority')[$counter])) ? $filtered->groupby('priority')[$counter]->count() : 0;
        }
      }

      $chartArray = [
        $ticketModule,
        $ticketPriority,
        $ticketStatus,
        $ticketClientModule,
        $ticketClientPriority,
      ];

      return $chartArray;
    }

    //chart ajax - END

    //Consultant - START

    public function consultantIndex()
    {
      $consultant = User::consultant()->with('assignments.moduls','assignments.submoduls')->get();
      $deactivated = User::onlyTrashed()->consultant()->with('assignments.moduls','assignments.submoduls')->get();

      return view('admin.consultant.index', compact('consultant'))->with('deactivated',$deactivated);
    }

    public function consultantAdd()
    {
      $modul = Modul::all();

      return view('admin.consultant.add', compact('modul'));
    }

    public function getSubmodules($modul_id)
    {
      $sub = Submodul::where('modul_id',$modul_id)->get();

      return $sub;
    }

    public function consultantStore(Request $req)
    {
      try {
        $consultant = User::create([
          'eid' => $req->eid,
          'name' => $req->name,
          'password' => bcrypt($req->eid),
          'role_id' => 2,
        ]);

        $assignment = Assignment::create([
          'eid' => $consultant->eid,
          'modul_id' => $req->module,
          'submodul_id' => $req->submodule,
        ]);
      } catch (\Illuminate\Database\QueryException $e) {
        return redirect()->back()->with('status', $e->getMessage());
      }

      return redirect('/consultant')->withSuccess('Consultant Successfully Added!');
    }

    public function consultantOptions($eid)
    {
      $consultant = User::consultant()->where('eid',$eid)->with('assignments.moduls','assignments.submoduls')->first();
      $modul = Modul::all();
      $submodul = Submodul::where('modul_id',$consultant->assignments->modul_id)->get();

      return view('admin.consultant.options', compact('consultant'))->with('modul',$modul)->with('submodul',$submodul);
    }

    public function consultantUpdate(Request $req, $eid)
    {
      try {
        User::consultant()->where('eid',$eid)->update([
          'eid' => $req->eid,
          'name' => $req->name,
        ]);

        Assignment::ofConsultant($eid)->update([
          'modul_id' => $req->module,
          'submodul_id' => $req->submodule,
        ]);
      } catch (\Illuminate\Database\QueryException $e) {
        return redirect()->back()->with('status','EID has been taken');
      }

      return redirect('/consultant')->withSuccess('Data has been updated!');
    }

    public function consultantDeactivate($eid)
    {
      $consultant = User::consultant()->where('eid',$eid)->delete();

      return redirect('/consultant')->withSuccess('Account '.$eid.' has been Deactivated');
    }

    public function consultantResetPassword($eid)
    {
      $consultant = User::consultant()->where('eid',$eid)->first();
      $consultant->password = bcrypt($consultant->eid);
      $consultant->last_login = null;
      $consultant->save();

      return redirect()->back()->withSucess('Password has been reset');
    }

    //Consultant - END

    //Client - START

    public function clientIndex()
    {
      $client = Client::all();

      return view('admin.client.index', compact('client'));
    }

    public function clientStore(Request $req)
    {
      try {
        $client = Client::create(['name' => $req->name]);
      } catch (\Illuminate\Database\QueryException $e) {
        return redirect()->back()->with('status', $e->getMessage());
      }

      return redirect('/client')->withSuccess('Client Successfully Added');
    }

    public function clientOptions($id)
    {
      $client = Client::find($id);
      $pics = Pic::where('client_id',$id)->get();

      return view('admin.client.options',compact('client'))->with('pics',$pics);
    }

    public function clientUpdate(Request $req, $id)
    {
      try {
        Client::where('id',$id)->update([
          'name' => $req->name,
        ]);
      } catch (\Illuminate\Database\QueryException $e) {
        return redirect()->back()->with('status', $e->getMessage());
      }
      return redirect('/client')->withSuccess('Data Successfully Updated');
    }

    public function clientDelete($id)
    {
      Client::destroy($id);
      return redirect('/client')->withSuccess('Data Successfully Deleted');
    }

    public function clientPicApprove($id)
    {
      $pic = Pic::find($id);
      $pic->approved_at = Carbon::now()->toDateTimeString();
      $pic->save();

      $data = [
        'name' => $pic->name,
        'email' => $pic->email,
      ];

      Mail::to($pic->email)->send(new ApprovedMail($data));

      return redirect('/client')->withSuccess('PIC Approved');
    }

    public function clientPicUnapprove($id)
    {
      Pic::where('id',$id)->update(['approved_at' => null]);

      return redirect('/client')->withSuccess('PIC Unapproved');
    }

    //Client - end

    //Module - START

    public function moduleIndex()
    {
      $modul = Modul::with('submoduls')->get();

      return view('admin.module.index', compact('modul'));
    }

    public function moduleStore(Request $req)
    {
      try {
        $modul = Modul::create(['id' => $req->id, 'name' => $req->name]);

        $submodule_arr = array_combine($req->submodule_id, $req->submodule);

        foreach ($submodule_arr as $key => $value) {
          $submodul = Submodul::create([
            'id' => $key,
            'name' => $value,
            'modul_id' => $modul->id,
          ]);

        }
      } catch (\Illuminate\Database\QueryException $e) {
        return redirect()->back()->with('status', $e->getMessage());
      }

      return redirect('/module')->with('status','Module Successfully Added!');
    }

    public function moduleOptions($id)
    {
      $modul = Modul::ofModule($id)->first();

      return view('admin.module.options', compact('modul'));
    }

    public function moduleUpdate(Request $req, $id)
    {
      try {

        $modul = Modul::ofModule($id)->first();
        $modul->id = $req->id;
        $modul->name = $req->name;
        $modul->save();

        $submodule_arr = array_combine($req->submodule_id, $req->submodule);

        foreach ($modul->submoduls as $sub) {
          if (!array_key_exists($sub->id,$submodule_arr)) {
            Submodul::destroy($sub->id);
          }
        }

        foreach ($submodule_arr as $key => $value) {
          Submodul::updateorCreate(
            [
              'id' => $key,
            ],
            [
              'id' => $key,
              'name' => $value,
              'modul_id' => $req->id,
            ]
          );
        }

      } catch (\Illuminate\Database\QueryException $e) {
        return redirect()->back()->with('status',$e->getMessage());
      }

      return redirect('/module')->withSucess('Data has been updated!');
    }

    //Module - END

    //Setting - START

    public function settingsIndex()
    {
      return view('admin.settings');
    }

    public function settingsUpdatePassword(Request $req, $eid)
    {

      $validated = $req->validate([
        'newpassword' => 'required|min:8',
        'confirmpassword' => 'required|min:8|in:'.$req->newpassword,
      ]);

      User::where('eid',$eid)->update([
        'password' => bcrypt($req->confirmpassword),
      ]);

      return redirect('/settings')->withSuccess('Password has been changed!');

    }

    //Setting - END


}
