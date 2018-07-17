<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;



class AdminController extends Controller
{
    public function index(){
        $user = Auth::user();
        $comptables = DB::table('users')
                     ->where('isadmin', 0)
                     ->get();
        
        return view('admin.index', compact('user', 'comptables'));
    }

    public function pointages() {
        $user = Auth::user();
        $comptables = DB::table('users')
                     ->where([
                         ['isadmin', 0],
                         ['apointer', 1]
                     ])
                     ->get();
        
        return view('admin.pointages', compact('user', 'comptables'));
    }

    public function getOneComptable($matricule) {
        $comptable = DB::table('users')
        ->where('matricule', $matricule)
        ->get()
        ->first();

        return view('admin.comptable', compact('comptable'));

    }

    public function updateComptable(Request $request  , $matricule) {

        $this->validate($request,[
            'lastname' => 'required',
            'firstname' => 'required',
            'matricule' => 'required',
        ]);

        /*DB::table('users')
        ->where('matricule', $matricule)
        ->update([
            ['firstname' => $request->input('firstname')],
            ['lastname' => $request->input('lastname')],
            ['matricule' => $request->input('matricule')]
        ]);*/

        $user = User::where('matricule',$matricule)->first();

        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->matricule = $request->input('matricule');

        $user->update();

        
        return redirect()->back()->withOk("Les informations du comptable ont été modifié avec succes");
    }

    public function allComptables() {
        $user = Auth::user();
        $comptables = DB::table('users')
                     ->where('isadmin', 0)
                     ->get();
        
        return view('admin.allcomptables', compact('user', 'comptables'));
    }

    public function allPointages() {
        $user = Auth::user();
        $comptables = DB::table('users')
                     ->where([
                         ['isadmin', 0],
                         ['apointer', 1]
                     ])
                     ->get();
        
        return view('admin.allpointages', compact('user', 'comptables'));
    }
}
