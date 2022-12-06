<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Rekam_MedisController extends Controller
{
    public function search_trash(Request $request)
    {
        $get_nama = $request->nama_rekam_medis;
        $datas = DB::table('rekam_medis')->where('deleted_at', '<>', '' )->where('id_rm', 'LIKE', '%'.$get_nama.'%')->get();
        return view('rekam_medis.trash')
        ->with('datas', $datas);
    }
    public function restore($id)
    {
        DB::update('UPDATE rekam_medis SET deleted_at=null WHERE id_rm = :id_rm', ['id_rm' => $id]);
        return redirect()->route('rekam_medis.trash')->with('success', 'Data rekam medis berhasil di restore');
    }
    public function trash()
    {
        $datas = DB::select('select * from rekam_medis where deleted_at is not null');
        return view('rekam_medis.trash')
            ->with('datas', $datas);
    }
    public function hide($id)
    {
        DB::update('UPDATE rekam_medis SET deleted_at=current_timestamp() WHERE id_rm = :id_rm', ['id_rm' => $id]);
        return redirect()->route('rekam_medis.index')->with('success', 'Data rekam medis berhasil dihapus');
    }

    public function index() {
        $datas = DB::select('select * from rekam_medis where deleted_at is null');

        return view('rekam_medis.index')
            ->with('datas', $datas);
    }

    public function create() {
        return view('rekam_medis.add');
    }

    public function store(Request $request) {
        $request->validate([
            'id_rm' => 'required',
            'id_pasien' => 'required',
            'id_apoteker' => 'required',
            'id_dokter' => 'required',
            'keluhan' => 'required',
            'diagnosa' => 'required',
            'tgl_periksa' => 'required',
            
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO rekam_medis(id_rm, id_pasien, id_apoteker, id_dokter, keluhan, diagnosa, tgl_periksa) VALUES (:id_rm, :id_pasien, :id_apoteker, :id_dokter, :keluhan, :diagnosa, :tgl_periksa)',
        [
            'id_rm' => $request->id_rm,
            'id_pasien' => $request->id_pasien,
            'id_apoteker' => $request->id_apoteker,
            'id_dokter' => $request->id_dokter,
            'keluhan' => $request->keluhan,
            'diagnosa' => $request->diagnosa, 
            'tgl_periksa' => $request->tgl_periksa,  
        ]
        );

        // Menggunakan laravel eloquent
        // Admin::create([
        //     'id_admin' => $request->id_admin,
        //     'id_pasien_admin' => $request->id_pasien_admin,
        //     'id_apoteker' => $request->id_apoteker,
        //     'username' => $request->username,
        //     'password' => Hash::make($request->password),
        // ]);

        return redirect()->route('rekam_medis.index')->with('success', 'Data rekam medis berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('rekam_medis')->where('id_rm', $id)->first();

        return view('rekam_medis.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'id_rm' => 'required',
            'id_pasien' => 'required',
            'id_apoteker' => 'required',
            'id_dokter' => 'required',
            'keluhan' => 'required',
            'diagnosa' => 'required',
            'tgl_periksa' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE rekam_medis SET id_rm = :id_rm, id_pasien = :id_pasien, id_apoteker = :id_apoteker, id_dokter= :id_dokter, keluhan = :keluhan, diagnosa = :diagnosa, tgl_periksa = :tgl_periksa WHERE id_rm = :id',
        [
            'id' => $id,
            'id_rm' => $request->id_rm,
            'id_pasien' => $request->id_pasien,
            'id_apoteker' => $request->id_apoteker,
            'id_dokter' => $request->id_dokter,
            'keluhan' => $request->keluhan,
            'diagnosa' => $request->diagnosa,
            'tgl_periksa' => $request->tgl_periksa,
        ]
        );
        return redirect()->route('rekam_medis.index')->with('success', 'Data rekammedis berhasil diubah');
    }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM rekam_medis WHERE id_rm = :id_rm', ['id_rm' => $id]);

        // Menggunakan laravel eloquent
        // Admin::where('id_admin', $id)->delete();

        return redirect()->route('rekam_medis.index')->with('success', 'Data rekam medis berhasil dihapus');
    }

    public function search(Request $request)
    {
        $get_nama = $request->nama;
        $datas = DB::table('rekam_medis')->where('id_rm', 'LIKE', '%'.$get_nama.'%')->get();
        return view('rekam_medis.index')->with('datas',$datas);
    }
}