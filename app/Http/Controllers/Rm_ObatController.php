<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Rm_ObatController extends Controller
{
    public function search_trash(Request $request)
    {
        $get_nama = $request->nama_obat;
        $datas = DB::table('rm_obat')->where('deleted_at', '<>', '' )->where('nama_obat', 'LIKE', '%'.$get_nama.'%')->get();
        return view('rm_obat.trash')
        ->with('datas', $datas);
    }
    public function restore($id)
    {
        DB::update('UPDATE rm_obat SET deleted_at=null WHERE id_obat = :id_obat', ['id_obat' => $id]);
        return redirect()->route('rm_obat.trash')->with('success', 'Data obat berhasil di restore');
    }
    public function trash()
    {
        $datas = DB::select('select * from rm_obat where deleted_at is not null');
        return view('rm_obat.trash')
            ->with('datas', $datas);
    }
    public function hide($id)
    {
        DB::update('UPDATE rm_obat SET deleted_at=current_timestamp() WHERE id_obat = :id_obat', ['id_obat' => $id]);
        return redirect()->route('rm_obat.index')->with('success', 'Data obat berhasil dihapus');
    }

    public function index() {
        $datas = DB::select('select * from rm_obat where deleted_at is null');

        return view('rm_obat.index')
            ->with('datas', $datas);
    }

    public function create() {
        return view('rm_obat.add');
    }

    public function store(Request $request) {
        $request->validate([
            'id_obat' => 'required',
            'nama_obat' => 'required',
            'jmlh_obat' => 'required',
            'harga' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO rm_obat(id_obat, nama_obat, jmlh_obat, harga) VALUES (:id_obat, :nama_obat, :jmlh_obat, :harga)',
        [
            'id_obat' => $request->id_obat,
            'nama_obat' => $request->nama_obat,
            'jmlh_obat' => $request->jmlh_obat,
            'harga' => $request->harga,
        ]
        );
        return redirect()->route('rm_obat.index')->with('success', 'Data obat berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('rm_obat')->where('id_obat', $id)->first();

        return view('rm_obat.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'id_obat' => 'required',
            'nama_obat' => 'required',
            'jmlh_obat' => 'required',
            'harga' => 'required',
        ]);
            DB::update('UPDATE rm_obat SET id_obat = :id_obat, nama_obat = :nama_obat, jmlh_obat = :jmlh_obat, harga = :harga WHERE id_obat = :id',
        [
            'id' => $id,
            'id_obat' => $request->id_obat,
            'nama_obat' => $request->nama_obat,
            'jmlh_obat' => $request->jmlh_obat,
            'harga' => $request->harga,
        ]
        );
        return redirect()->route('rm_obat.index')->with('success', 'Data obat berhasil diubah');
        }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM rm_obat WHERE id_obat = :id_obat', ['id_obat' => $id]);

        // Menggunakan laravel eloquent
        // obat::where('id_obat', $id)->delete();

        return redirect()->route('rm_obat.index')->with('success', 'Data obat berhasil dihapus');
    }

    public function search(Request $request)
    {
        $get_nama = $request->nama;
        $datas = DB::table('rm_obat')->where('nama_obat', 'LIKE', '%'.$get_nama.'%')->get();
        return view('rm_obat.index')->with('datas',$datas);
    }
}