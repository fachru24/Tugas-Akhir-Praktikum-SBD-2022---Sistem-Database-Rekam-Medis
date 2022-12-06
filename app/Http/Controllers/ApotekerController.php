<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ApotekerController extends Controller
{
    public function search_trash(Request $request)
    {
        $get_nama = $request->nama_apoteker;
        $datas = DB::table('apoteker')->where('deleted_at', '<>', '' )->where('nama_apoteker', 'LIKE', '%'.$get_nama.'%')->get();
        return view('apoteker.trash')
        ->with('datas', $datas);
    }
    public function restore($id)
    {
        DB::update('UPDATE apoteker SET deleted_at=null WHERE id_apoteker = :id_apoteker', ['id_apoteker' => $id]);
        return redirect()->route('apoteker.trash')->with('success', 'Data apoteker berhasil di restore');
    }
    public function trash()
    {
        $datas = DB::select('select * from apoteker where deleted_at is not null');
        return view('apoteker.trash')
            ->with('datas', $datas);
    }
    public function hide($id)
    {
        DB::update('UPDATE apoteker SET deleted_at=current_timestamp() WHERE id_apoteker = :id_apoteker', ['id_apoteker' => $id]);
        return redirect()->route('apoteker.index')->with('success', 'Data apoteker berhasil dihapus');
    }

    public function index() {
        $datas = DB::select('select * from apoteker where deleted_at is null');

        return view('apoteker.index')
            ->with('datas', $datas);
    }

    public function create() {
        return view('apoteker.add');
    }

    public function store(Request $request) {
        $request->validate([
            'id_apoteker' => 'required',
            'nama_apoteker' => 'required',
            'username' => 'required',
            'pass' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO apoteker(id_apoteker, nama_apoteker, username, pass) VALUES (:id_apoteker, :nama_apoteker, :username, :pass)',
        [
            'id_apoteker' => $request->id_apoteker,
            'nama_apoteker' => $request->nama_apoteker,
            'username' => $request->username,
            'pass' => $request->pass,
        ]
        );

        return redirect()->route('apoteker.index')->with('success', 'Data apoteker berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('apoteker')->where('id_apoteker', $id)->first();

        return view('apoteker.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'id_apoteker' => 'required',
            'nama_apoteker' => 'required',
            'username' => 'required',
            'pass' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE apoteker SET id_apoteker = :id_apoteker, nama_apoteker = :nama_apoteker, username = :username, pass = :pass WHERE id_apoteker = :id',
        [
            'id' => $id,
            'id_apoteker' => $request->id_apoteker,
            'nama_apoteker' => $request->nama_apoteker,
            'username' => $request->username,
            'pass' => $request->pass,
            
        ]
        );
        return redirect()->route('apoteker.index')->with('success', 'Data apoteker berhasil diubah');
    }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM apoteker WHERE id_apoteker = :id_apoteker', ['id_apoteker' => $id]);

        // Menggunakan laravel eloquent
        // Admin::where('id_admin', $id)->delete();

        return redirect()->route('apoteker.index')->with('success', 'Data apoteker berhasil dihapus');
    }

    public function search(Request $request)
    {
        $get_nama = $request->nama;
        $datas = DB::table('apoteker')->where('nama_apoteker', 'LIKE', '%'.$get_nama.'%')->get();
        return view('apoteker.index')->with('datas',$datas);
    }
}