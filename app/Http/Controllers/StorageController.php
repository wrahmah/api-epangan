<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class StorageController extends Controller
{
    
    function listmini(){

        $data = DB::select("SELECT * FROM storages");
            return response()->json(
                [
                    "message" => "GET Method success",
                    "data"    => $data
                ]
            );
    }

    function post(request $request){
        return response()->json(
            [
                "message" => "Post Method success",
       
            ]
        );

    }
    function get(){
        return response()->json(
            [
                "message" => "GET Method success",
       
            ]
        );

    }
    function put($id){
        return response()->json(
            [
                "message" => "GET Method success",
       
            ]
        );

    }

}
