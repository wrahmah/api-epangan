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
    }

    function createmini(request $request){

        $last_number = DB::table('storages')
                                ->orderBy('kode_karyawan', 'desc')->first();
    
        if ($last_number == null) {

            $kode_karyawan      = 'KW'. '000001';

        }else{

            $last_number    = DB::table('storages')
                                        ->orderBy('kode_karyawan', 'desc')->first()->kode_karyawan;

            $lastIncreament = substr($last_number, -6);

            // Make a new order id with appending last increment + 1
            $kode_karyawan      = 'KW' . str_pad($lastIncreament + 1, 6, 0, STR_PAD_LEFT);   
        }

        if($request->id == 1){
            DB::table('storages')->insert([
            'id_storage'    => $request->id_storage,
            'name_storage'  => $request->nama_storage,
            'no_telepon'    => $request->no_telp,
            'id_provinsi'   => $request->provinsi,
            'id_kabupaten'  => $request->kabupaten,
            'id_kecamatan'  => $request->kecamatan,
            'id_desa'       => $request->desa,
            'kode_pos'      => $request->kodepos,
            'email'         => $request->email,
            'jenis_storage' => $request->id,
            'jenis_penyimpanan' => $request->jenis_penyimpanan,
            'kode_karyawan'     => $kode_karyawan,
            'alamat'            => $request->alamat,
            'status'            => 0,
            'tanggal_dibuat'    => date('Y-m-d'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);

        return "berhasil";

        }elseif($request->id == 2){

            DB::table('storages')->insert([
            'id_storage'    => $request->id_storage,
            'name_storage'  => $request->nama_storage,
            'no_telepon'    => $request->no_telp,
            'id_provinsi'   => $request->provinsi,
            'id_kabupaten'  => $request->kabupaten,
            'id_kecamatan'  => $request->kecamatan,
            'id_desa'       => $request->desa,
            'kode_pos'      => $request->kodepos,
            'email'         => $request->email,
            'jenis_storage' => $request->id,
            'jenis_penyimpanan' => $request->jenis_penyimpanan,
            'kode_karyawan'     => $kode_karyawan,
            'alamat'            => $request->alamat,
            'status'            => 0,
            'jml_ruangan'       => $request->jml_ruangan
            'tanggal_dibuat'    => date('Y-m-d'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);

        return "berhasil";
        }
      

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
