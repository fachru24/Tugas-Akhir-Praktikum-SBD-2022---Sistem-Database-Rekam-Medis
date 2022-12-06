<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DokterController extends Controller
{
    public function search_trash(Request $request)
    {
        $get_nama = $request->nama_dokter;
        $datas = DB::table('dokter')->where('deleted_at', '<>', '' )->where('nama_dokter', 'LIKE', '%'.$get_nama.'%')->get();
        return view('dokter.trash')
        ->with('datas', $datas);
    }
    public function restore($id)
    {
        DB::update('UPDATE dokter SET deleted_at=null WHERE id_dokter = :id_dokter', ['id_dokter' => $id]);
        return redirect()->route('dokter.trash')->with('success', 'Data dokter berhasil di restore');
    }
    public function trash()
    {
        $datas = DB::select('select * from dokter where deleted_at is not null');
        return view('dokter.trash')
            ->with('datas', $datas);
    }
    public function hide($id)
    {
        DB::update('UPDATE dokter SET deleted_at=current_timestamp() WHERE id_dokter = :id_dokter', ['id_dokter' => $id]);
        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil dihapus');
    }

    public function index() {
        $datas = DB::select('select * from dokter where deleted_at is null');

        return view('dokter.index')
            ->with('datas', $datas);
    }

    public function create() {
        return view('dokter.add');
    }

    public function store(Request $request) {
        $request->validate([
            'id_dokter' => 'required',
            'nama_dokter' => 'required',
            'jadwal' => 'required',
            
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO dokter(id_dokter, nama_dokter, jadwal) VALUES (:id_dokter, :nama_dokter, :jadwal)',
        [
            'id_dokter' => $request->id_dokter,
            'nama_dokter' => $request->nama_dokter,
            'jadwal' => $request->jadwal,
            
            
        ]
        );

        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('dokter')->where('id_dokter', $id)->first();

        return view('dokter.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'id_dokter' => 'required',
            'nama_dokter' => 'required',
            'jadwal' => 'required',
        ]);
            DB::update('UPDATE dokter SET id_dokter = :id_dokter, nama_dokter = :nama_dokter, jadwal = :jadwal WHERE id_dokter = :id',
        [
            'id' => $id,
            'id_dokter' => $request->id_dokter,
            'nama_dokter' => $request->nama_dokter,
            'jadwal' => $request->jadwal,
        ]
        );
        return redirect()->route('dokter.index')->with('success', 'Data obat berhasil diubah');
        }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM dokter WHERE id_dokter = :id_dokter', ['id_dokter' => $id]);

        // Menggunakan laravel eloquent
        // Admin::where('id_admin', $id)->delete();

        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil dihapus');
    }

    public function search(Request $request)
    {
        $get_nama = $request->nama;
        $datas = DB::table('dokter')->where('nama_dokter', 'LIKE', '%'.$get_nama.'%')->get();
        return view('dokter.index')->with('datas',$datas);
    }
}