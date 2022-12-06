<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PasienController extends Controller
{
    public function search_trash(Request $request)
    {
        $get_nama = $request->nama_pasien;
        $datas = DB::table('pasien')->where('deleted_at', '<>', '' )->where('nama_pasien', 'LIKE', '%'.$get_nama.'%')->get();
        return view('pasien.trash')
        ->with('datas', $datas);
    }
    public function restore($id)
    {
        DB::update('UPDATE pasien SET deleted_at=null WHERE id_pasien = :id_pasien', ['id_pasien' => $id]);
        return redirect()->route('pasien.trash')->with('success', 'Data pasien berhasil di restore');
    }
    public function trash()
    {
        $datas = DB::select('select * from pasien where deleted_at is not null');
        return view('pasien.trash')
            ->with('datas', $datas);
    }
    public function hide($id)
    {
        DB::update('UPDATE pasien SET deleted_at=current_timestamp() WHERE id_pasien = :id_pasien', ['id_pasien' => $id]);
        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil dihapus');
    }

    public function index() {
        $datas = DB::select('select * from pasien where deleted_at is null');

        return view('pasien.index')
            ->with('datas', $datas);
    }

    public function create() {
        return view('pasien.add');
    }

    public function store(Request $request) {
        $request->validate([
            'id_pasien' => 'required',
            'nama_pasien' => 'required',
            'nik' => 'required',
            'alamat' => 'required',
            'no_tlp' => 'required'
            
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO pasien(id_pasien, nama_pasien, nik, alamat, no_tlp) VALUES (:id_pasien, :nama_pasien, :nik, :alamat, :no_tlp)',
        [
            'id_pasien' => $request->id_pasien,
            'nama_pasien' => $request->nama_pasien,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'no_tlp' => $request->no_tlp,
            
            
        ]
        );

        // Menggunakan laravel eloquent
        // Admin::create([
        //     'id_admin' => $request->id_admin,
        //     'nama_pasien_admin' => $request->nama_pasien_admin,
        //     'alamat' => $request->alamat,
        //     'username' => $request->username,
        //     'password' => Hash::make($request->password),
        // ]);

        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('pasien')->where('id_pasien', $id)->first();

        return view('pasien.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'id_pasien' => 'required',
            'nama_pasien' => 'required',
            'nik' => 'required',
            'alamat' => 'required',
            'no_tlp' => 'required',
            
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE pasien SET id_pasien = :id_pasien, nama_pasien = :nama_pasien, alamat = :alamat, no_tlp= :no_tlp, nik = :nik WHERE id_pasien = :id',
        [
            'id' => $id,
            'id_pasien' => $request->id_pasien,
            'nama_pasien' => $request->nama_pasien,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'no_tlp' => $request->no_tlp,
            
        ]
        );
        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil diubah');
    }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM pasien WHERE id_pasien = :id_pasien', ['id_pasien' => $id]);

        // Menggunakan laravel eloquent
        // Admin::where('id_admin', $id)->delete();

        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil dihapus');
    }


    public function search(Request $request)
    {
        $get_nama = $request->nama;
        $datas = DB::table('pasien')->where('id_pasien', 'LIKE', '%'.$get_nama.'%')->get();
        return view('pasien.index')->with('datas',$datas);
    }
}