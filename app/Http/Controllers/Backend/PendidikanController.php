<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Pendidikan;
use Illuminate\Http\Request;

class PendidikanController extends Controller
{
    public function index()
    {
        $pendidikan = DB::table('pendidikan')->get();
        return view('backend.pendidikan.index',compact('pendidikan'));
    }

    public function create()
    {
        $pendidikan = null;
        return view('backend.pendidikan.create', compact('pendidikan'));
    }

    public function store(Request $request)
    {
        // Pendidikan::create($request->all());

        DB::table('pendidikan')->insert([
            'nama' => $request->nama,
            'tingkatan' => $request->tingkatan,
            'tahun_masuk' => $request->tahun_masuk,
            'tahun_keluar' => $request->tahun_keluar,
        ]);

        return redirect()->route('pendidikan.index')
            ->with('success', 'Data Pendidikan baru telah berhasil disimpan.');
    }

    public function edit($id)
    {
        $pendidikan = DB::table('pendidikan')->where('id', $id)->first();
        return view('backend.pendidikan.create', compact('pendidikan'));
    }

    public function update(Request $request)
    {
        DB::table('pendidikan')->where('id', $request->id)->update([
            'nama' => $request->nama,
            'tingkatan' => $request->tingkatan,
            'tahun_masuk' => $request->tahun_masuk,
            'tahun_keluar' => $request->tahun_keluar,
        ]);

        return redirect()->route('pendidikan.index')
            ->with('success', 'Pendidikan berhasil diperbaharui.');
    }
}