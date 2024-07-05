<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use App\Models\Menu;
use App\Models\Reservasi;
use Faker\Core\File;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservasi = Reservasi::all();
        return view('reservasi.index')
            ->with('reservasi',$reservasi);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $meja = Meja::all();
        $menu = Menu::all();
        return view('reservasi.create')->with('menu',$menu)->with('meja',$meja);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->user()->cannot('create',Reservasi::class)){
            abort(403);
        }
        $val = $request->validate([
            'meja_id'=>"required",
            'no_reservasi' => "required",
            'menu_id'=>"required",
            'nama'=>"required|max:45",
            'no_telpon'=>"required|max:45",
            'tanggal_reservasi'=>"required",
        ]);
        Reservasi::create($val);
        return redirect()->route('reservasi.index')->with('success',$val['nama'].' Berhasil disimpan');

    }

    /**
     * Display the specified resource.
     */
    public function show(Reservasi $reservasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservasi $reservasi)
    {
        $meja = Meja::all();
        $menu = Menu::all();
        return view('reservasi.edit')->with('meja',$meja)->with('menu',$menu)->with('reservasi',$reservasi);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservasi $reservasi)
    {
        if ($request->user()->cannot('create',Reservasi::class)){
            abort(403);
        }
        $val = $request->validate([
            'meja_id'=>"required",
            'no_reservasi' => "required|unique:reservasis",
            'menu_id'=>"required",
            'nama'=>"required|max:45",
            'no_telpon'=>"required|max:45",
            'tanggal_reservasi'=>"required",

        ]);
                
        Reservasi::where('id', $reservasi['id'])->update($val);
        return redirect()->route('reservasi.index')->with('success',$val['nama'].' Berhasil di Edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservasi $reservasi)
    {
       
        $reservasi->delete(); // hapus data mahasiswa
        return redirect()->route('reservasi.index')->with('success','Data Berhasil di Hapus!');
    }
}
