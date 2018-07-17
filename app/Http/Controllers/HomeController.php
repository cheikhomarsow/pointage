<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if($user->isadmin) {
            return redirect('admin');
        }
        
        if($user->apointer == 0){
            $code = strtoupper(str_random(5));

            DB::table('codes')->insert([
                [
                    'matricule' => $user->matricule,
                    'code' => $code,
                ]
            ]);
            return view('home', compact('code', 'user'));
        }else{
            $pointage = DB::table('pointage')
            ->where([
                ['matricule', $user->matricule],
            ])
            ->orderBy('created_at','DESC')
            ->get()->first();

            return view('profile', compact('user', 'pointage'));
        }
        
        
    }

   

    public function pointage(Request $request) {
        $this->validate($request,[
            'code' => 'required'
        ]);

        $tmp = Carbon::now()->subMinutes(15);
        $user = Auth::user();

        $matricule = Auth::user()->matricule;
        $code = $request->input('code');

        $codeExist = DB::table('codes')
                     ->where([
                         ['matricule', $matricule],
                         ['code', $code],
                         ])
                     ->orderBy('created_at', 'DESC')
                     ->get()->first();

        if($codeExist !== null){
            DB::table('pointage')->insert([
                [
                    'matricule' => $user->matricule,
                    'modifier' => false,
                    'created_at' => $tmp,
                    'updated_at' => $tmp
                ]
            ]);

            DB::table('users')
            ->where('matricule', $matricule)
            ->update(['apointer' => true]);

            $pointage = DB::table('pointage')
            ->where([
                ['matricule', $matricule],
            ])
            ->orderBy('created_at','DESC')
            ->get()->first();

            return view('profile', compact('user', 'pointage'));
        }else{
            return redirect()->back();
        }
        
        

    }
}
