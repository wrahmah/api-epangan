<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use DataTables;

class ProsesController extends Controller
{
    public function list_receive(){
        
    	$data =[

            'menu' =>DB::select('select * from menus order by sort ASC'),
            'submenu' => DB::select('select * from menus join submenu on menus.title=submenu.Parent'),
        ];


    	return view('proses.penerimaan.list',$data);
    }
    public function get_listreceive(){
        $today = date('Y-m-d');
        $data = DB::select("SELECT * FROM detail_barang join penerimaan on penerimaan.id_penerimaan=detail_barang.penerimaan_id join petani on petani.id_petani=penerimaan.petani_id order by penerimaan.tgl_penerimaan desc");

        return Datatables::of($data)
            ->addColumn('actions', function ($data) {
                $btn = '<div class="d-flex align-items-center">
                              <div class="dropdown dropdown-inline mr-1">
                                    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
                                        <i class="la la-eye"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                    <ul class="nav nav-hoverable flex-column">
                                        <li class="nav-item"><a class="nav-link" href="tree/detail/'.$data->id_penerimaan.'"><i class="nav-icon la la-edit"></i><span class="nav-text">Details</span></a></li>
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
    public function formreceive(request $req){
        $last_number = DB::table('penerimaan')
                                ->orderBy('id_penerimaan', 'desc')->first();
    
        if ($last_number == null) {

            $newnumber      = 'R'.date('dmY').'01';

        }else{

            $last_number    = DB::table('penerimaan')
                                        ->orderBy('id_penerimaan', 'desc')->first()->id_penerimaan;

            $lastIncreament = substr($last_number, -2);

            // Make a new order id with appending last increment + 1
            $newnumber      = 'R' .date('dmY'). str_pad($lastIncreament + 1, 2, 0, STR_PAD_LEFT);   
        }
    	$data =[
            'menu'      => DB::select('select * from menus order by sort ASC'),
            'submenu'   => DB::select('select * from menus join submenu on menus.title=submenu.Parent'),
            'petani'    => DB::select('select * from petani'),
            'number'    => $newnumber,
        ];

       
    	return view('proses.penerimaan.form',$data);
    }
    function create_receive(request $req){
        DB::table('penerimaan')->insert([
                'id_penerimaan'       => $req ->id_penerimaan,
                'id_petani'           => $req ->id_petani,
                'tgl_penerimaan'      => date('Y-m-d'),
                'created_at'          => date('Y-m-d H:i:s'),
                'updated_at'          => date('Y-m-d H:i:s'),
            ]);

        if(count($req->id)>0){
           
                foreach($req->id as $qty) {

                    $data=array(

                        'id_barang'       => $req->id_barang[$qty],
                        'jenis_barang'    => $req->jenis[$qty],
                        'barang'          => $req->barang[$qty],
                        'berat'           => $req->berat[$qty],
                        'penerimaan_id'   => $req->id_penerimaan,
                        'created_at'      => date('Y-m-d H:i:s'),
                        'updated_at'      => date('Y-m-d H:i:s'),
                    );
                    DB::table('detail_barang')->insert($data);
                
                }
            }

            return "berhasil";
    }
}
