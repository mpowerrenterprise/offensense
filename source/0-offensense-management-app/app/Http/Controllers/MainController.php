<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Hash;
use Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{

    public function viewAuthentication(){

        return view('authentication');
    }

    public function loginProcess(Request $request){

        // Validate the form data
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Attempt to log the user in
        $usernames = DB::table('users')->pluck('username');
        $password = DB::table('users')->pluck('password');

        if ($usernames[0] == $request->input('username') && Hash::check($request->input('password'), $password[0])) {
            Session::put('LoginSession', '[TRUE]');
            return redirect()->intended('/dashboard'); // Redirect to the intended URL or a default one
        }

        // Authentication failed
        return back()->withErrors(['username' => 'Invalid login credentials'])->withInput();
    }


     // Logout
     public function logoutProcess()
     {
        if (Session::get('LoginSession') == "[TRUE]"){
            session()->forget('LoginSession');
            return redirect('/');
        }else{
            return redirect('/');
        }
         
     }

    public function viewDashbard(){
        if (Session::get('LoginSession') == "[TRUE]"){
            $Data = DB::select(DB::raw("SELECT * FROM predictions ORDER BY autoid DESC"));
            return view('dashboard')->with(["Data" => $Data]);
        }else{
            return redirect('/');
        }
    }

    public function viewDataset(){

        if (Session::get('LoginSession') == "[TRUE]"){
            $Data = DB::select( DB::raw("SELECT * FROM words"));
            return view('dataset')->with(["Data" => $Data]);
        }else{
            return redirect('/');
        }

    }

    public function deleteWord($id){
       if (Session::get('LoginSession') == "[TRUE]"){
            if(DB::table('words')->where(['autoid' => $id])->delete()){
                return Redirect::to('/dataset');
            }
        }else{

            return redirect('/');
        }

    }

    public function addWord($word){
        if (Session::get('LoginSession') == "[TRUE]"){
            $data=array('word'=>$word);          
            if(DB::table('words')->insert($data)){
                return Redirect::to('/dataset');
            }
        }else{

            return redirect('/');
        }
    }
}
