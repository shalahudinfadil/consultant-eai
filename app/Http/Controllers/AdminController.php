<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Modul;
use App\Submodul;
use App\Client;
use App\Role;
use App\Assignment;

class AdminController extends Controller
{
    public function __construct()
    {
      $this->middleware('admin');
    }

    public function dashboard()
    {
      return view('layouts.admin');
    }

    public function consultantIndex()
    {
      $consultant = User::where('role_id',2)->with('assignments.moduls','assignments.submoduls')->get();

      return view('admin.consultant.index', compact('consultant'));
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

      return redirect('/consultant')->with('status','Consultant Successfully Added!');
    }

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

      return redirect('/client')->with('status','Client Successfully Added');
    }

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

}
