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
            $newnumber      = 'ST' . str_pad($lastIncreament + 1, 6, 0, STR_PAD_LEFT);  
            // $newnumber = 'ST000004' ;
            }


            $data =[
            'menu' =>DB::select('select * from menus order by sort ASC'),
            'submenu' => DB::select('select * from menus join submenu on menus.title=submenu.Parent'),
            'id'   => 1, 
            'number' => $newnumber,
            ];
            return $data;
         
    }

    function view_coldstorage(){

        $last_number = DB::table('storages')
            ->orderBy('id_storage', 'desc')->first();

            if ($last_number == null) {

            $newnumber      = 'ST'. '000001';

            }else{

            $last_number    = DB::table('storages')
                            ->orderBy('id_storage', 'desc')->first()->id_storage;

            $lastIncreament = substr($last_number, -6);

            // Make a new order id with appending last increment + 1
            $newnumber      = 'ST' . str_pad($lastIncreament + 1, 6, 0, STR_PAD_LEFT);  
            // $newnumber = 'ST000004' ;
            }


            $data =[
            'menu' =>DB::select('select * from menus order by sort ASC'),
            'submenu' => DB::select('select * from menus join submenu on menus.title=submenu.Parent'),
            'id'   => 2, 
            'number' => $newnumber,
            ];
            return $data;
         
    }

    public function form_petani(){
        $last_number = DB::table('petani')
                                ->orderBy('id_petani', 'desc')->first();
    
        if ($last_number == null) {

            $id_petani      = 'PK'. '000001';

        }else{

            $last_number    = DB::table('petani')
                                        ->orderBy('id_petani', 'desc')->first()->id_petani;

            $lastIncreament = substr($last_number, -6);

            // Make a new order id with appending last increment + 1
            $id_petani      = 'PK' . str_pad($lastIncreament + 1, 6, 0, STR_PAD_LEFT);   
        }
        $data =[
            'menu'      => DB::select('select * from menus order by sort ASC'),
            'submenu'   => DB::select('select * from menus join submenu on menus.title=submenu.Parent'),
            'number'    => $id_petani,
        ];

        return $data;
    }

    public function form_item_receive(Request $req, $param = null){

       
        if ($param == null) {
             $last_id = DB::table('detail_barang')
                                ->orderBy('id_barang', 'desc')->first();
            if ($last_id == null) {

                $newid      = 'KB-' . date('d') . '00000' . $req->id;

            }else{

               $last_id = DB::table('detail_barang')
                                    ->orderBy('id_barang', 'desc')->first()->id_barang;

                $lastin_id = substr($last_id, -6);

                // Make a new id with appending last increment + 1
                $newid     = 'KB-' . date('d') . str_pad($lastin_id + $req->id , 6, 0, STR_PAD_LEFT) ;
            }

            $data = [
                'kodebox' => $newid,
                'id'  => $req->id,

            ];
            return view('proses.penerimaan.form_item', $data);
        }  else if ($param == 'add-form') {

                $last_id = DB::table('detail_barang')
                                 ->orderBy('id_barang', 'desc')->first();

                if($last_id == null){
                    return $last_id;
                }else{
                    $last_id = DB::table('detail_barang')
                                 ->orderBy('id_barang', 'desc')->first()->id_barang;
                     return $last_id;
                }

            // return array(view('proses.penerimaan.form_item'), $last_id);
            
        }


    }
}
