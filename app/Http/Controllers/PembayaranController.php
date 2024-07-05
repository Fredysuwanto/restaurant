<?php

namespace App\Http\Controllers;

use App\Models\Kasir;
use App\Models\Pembayaran;

use App\Models\Meja;
use App\Models\Menu;
use App\Models\Pemesanan;
use App\Models\Reservasi;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembayaran = Pembayaran::all();
        return view('pembayaran.index')
            ->with('pembayaran',$pembayaran);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $reservasi = Reservasi::all();
        $meja = Meja::all();
        $menu = Menu::all();
        $kasir = Kasir::all();
        return view('pembayaran.create')->with('reservasi', $reservasi)->with('meja', $meja)->with('menu',$menu)->with('kasir',$kasir);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->user()->cannot('create',Pembayaran::class)){
            abort(403);
        }
        // dd($request);
        $val = $request->validate([
            'reservasi_id'=>"required|max:45",
            'meja_id'=>"required",
            'kasir_id'=>"required",
            'metode'=>"required",
            'menu_id' => "required",
            'jumlah'=>"required",
        ]);
        Pembayaran::create($val);
        return redirect()->route('pembayaran.index')->with('success',$val['jumlah'].' Berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(pembayaran $pembayaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pembayaran $pembayaran)
    {
        $reservasi = Reservasi::all();
        $meja = Meja::all();
        $menu = Menu::all();
        $kasir = Kasir::all();
        return view('pembayaran.edit')->with('reservasi', $reservasi)->with('meja', $meja)->with('menu',$menu)->with('kasir',$kasir)->with('pembayaran',$pembayaran);
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, pembayaran $pembayaran)
    {
        if ($request->user()->cannot('create',Pembayaran::class)){
            abort(403);
        }
        $val = $request->validate([
            'reservasi_id'=>"required|max:45",
            'meja_id'=>"required",
            'kasir_id'=>"required",
            'metode'=>"required",
            'menu_id' => "required",
            'jumlah'=>"required",
        ]);
        Pembayaran::where('id',$pembayaran['id'])->update($val);
        return redirect()->route('pembayaran.index')->with('success',$val['jumlah'].' Berhasil di edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pembayaran $pembayaran)
    {
        $pembayaran->delete(); // hapus data mahasiswa
        return redirect()->route('pembayaran.index')->with('success','Data Berhasil di Hapus!');
    }
}
