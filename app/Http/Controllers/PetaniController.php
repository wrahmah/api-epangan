<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetaniController extends Controller
{
    
    function create(request $request){

        $file = $request->file('foto');
        if($file != ''){

            $file->move("uploads/user/petani",$file->getClientOriginalName());
            $fileName = $file->getClientOriginalName();
        
        }else{
            $fileName = '';
        }

        return DB::table('petani')->insert([

                'id_petani' => $request->id_petani,
                'nama_petani'   => $request->nama_petani,
                'foto'          => $fileName,
                'telepon'    => $request->no_telp,
        ]);
    }

    function getdata($id){
        return DB::select('select * from petani where id_petani = "'.$id.'"');
    }

}
