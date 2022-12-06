<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index()
    {
        $datas = DB::table('rekam_medis')
                ->join('pasien', 'pasien.id_pasien', '=', 'rekam_medis.id_pasien')
                ->join('apoteker', 'apoteker.id_apoteker', '=', 'rekam_medis.id_apoteker')
                ->join('dokter', 'dokter.id_dokter', '=', 'rekam_medis.id_dokter')
                ->get();

        return view('home.index')
            ->with('datas', $datas);
    }

    public function join(Request $request) {
        if($request->has('search')){
            $datas = DB::select('SELECT rekam_medis.di_rm, rekam_medis.nama_rekam_medis, dokter.nama_dokter FROM `rekam_medis` JOIN rekam_medis ON rekam_medis.id_rm = rekam_medis.id_rm JOIN dokter on dokter.id_dokter = rekam_medis.id_dokter JOIN dokter on dokter.id_dokter = rekam_medis.id_dokter WHERE rekam_medis.nama_rekam_medis or dokter.nama_dokter like :search',[
                'search'=>'%'.$request->search.'%',
            ]);

        return view('join')
            ->with('datas', $datas);
        }
        else {
            $datas = DB::select('SELECT rekam_medis.id_rm, rekam_medis.keluhan, dokter.nama_dokter, dokter.nama_dokter, rekam_medis.keluahan.rekam_medis FROM `rekam_medis`  JOIN rekam_medis ON rekam_medis.id_rm = rekam_medis.id_rm  JOIN dokter on dokter.id_dokter = rekam_medis.id_dokter JOIN dokter on dokter.id_dokter = rekam_medis.id_dokter ORDER BY rekam_medis.id_rm');

        return view('join')
            ->with('datas', $datas);
        }
    }

}