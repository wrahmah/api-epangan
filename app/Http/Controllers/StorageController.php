<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
class StorageController extends Controller
{
    
    function getlistmini(){

        $data = DB::select("SELECT * FROM storages");
            
        return DataTables::of($data)
        ->addColumn('actions', function ($data) {
            $btn = '<div class="d-flex align-items-center">
                          <div class="dropdown dropdown-inline mr-1">
                                <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
                                    <i class="la la-cog"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <ul class="nav nav-hoverable flex-column">
                                      <li class="nav-item"><a class="nav-link" href="tree/detail"><i class="nav-icon la la-edit"></i><span class="nav-text">Details</span></a></li>
                                      <li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-leaf"></i><span class="nav-text">Update Status</span></a></li>\
                                     <li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-print"></i><span class="nav-text">Print</span></a></li>
                                </ul>
                             </div>
                         </div>
                          <a href="javascript:;" class="btn btn-sm btn-clean btn-icon mr-1" title="Edit details">
                              <i class="la la-edit"></i>
                         </a>
                          <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete">
                             <i class="la la-trash"></i>
                        </a>
                     </div>';
            return $btn;
        })
        ->rawColumns(['actions'])
        ->make(true);

        // return response()->json(
        //         [
        //             "message" => "GET Method success",
        //             "data"    => $data
        //         ]
        // );
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
