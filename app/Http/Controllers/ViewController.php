<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ViewController extends Controller
{
    function view_ministorage(){

        $last_number = DB::table('storages')
            ->orderBy('id_storage', 'desc')->first();

            if ($last_number == null) {

            $newnumber      = 'ST'. '000001';

            }else{

            $last_number    = DB::table('storages')
                            ->orderBy('id_storage', 'desc')->first()->id_storage;

            $lastIncreament = substr($last_number, -6);

            // Make a new order id with appending last increment + 1
            // $newnumber      = 'ST' . str_pad($lastIncreament + 1, 6, 0, STR_PAD_LEFT);  
            $newnumber = 'ST000004' ;
            }


            $data =[
            'menu' =>DB::select('select * from menus order by sort ASC'),
            'submenu' => DB::select('select * from menus join submenu on menus.title=submenu.Parent'),
            'id'   => 1, 
            'number' => $newnumber,
            ];

            return view('storage.mini.mini_form',$data);
    }
}
