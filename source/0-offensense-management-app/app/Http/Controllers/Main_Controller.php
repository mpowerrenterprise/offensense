<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use DB;

class Main_Controller extends Controller
{
    public function Index_Function(){

        $Data = DB::select(DB::raw("SELECT * FROM data ORDER BY auto_id DESC"));

        return view('Index')->with(["Data" => $Data]);
    }

    public function Word_Dataset(){

        $Data = DB::select( DB::raw("SELECT * FROM word"));
        
        return view('Dataset')->with(["Data" => $Data]);

    }

    public function DeleteWord($id){
       
        if(DB::table('word')->where(['auto_id' => $id])->delete()){

            return Redirect::to('/dataset');
        }

    }

    public function AddWord($word){

        $data=array('word'=>$word);    
            
        if(DB::table('word')->insert($data)){

            return Redirect::to('/dataset');

        }
    }
}
