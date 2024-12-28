<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobil;

class MobilController extends Controller
{
    public function index()
    {
        $mobil = Mobil::where('rental_mobil_id', auth()->user()->rentalMobil->id)->latest()->get();
        return view('mobil.index', [
            'mobils' => $mobil
        ]);
    }

    public function create()
    {
        return view('mobil.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'mimes:png,jpg|max:1000'
        ]);

        Mobil::create([
            'rental_mobil_id' => auth()->user()->rentalMobil->id,
            'plat_nomor' => $request->plat_nomor,
            'warna' => $request->warna,
            'merek' => $request->merek,
            'foto' => $request->file('foto')->store('mobil', 'public')
        ]);

        return redirect()->route('mobil.index')->with('success', 'Data Berhasil Ditambahkan!');
    }

    public function edit($id)
    {
        $mobil = Mobil::find($id);
        return view('mobil.edit', compact('mobil'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'foto' => 'mimes:png,jpg|max:1000'
        ]);

        $mobil = Mobil::find($id);
        $mobil->plat_nomor = $request->plat_nomor;
        $mobil->warna = $request->warna;
        $mobil->merek = $request->merek;

        if ($request->foto != null) {
            if ($mobil != null) {
                $fotoL = public_path('/storage/') . $mobil->foto;
                if (file_exists($fotoL)) {
                    @unlink($fotoL);
                }
            }

            $mobil->foto = $request->file('foto')->store('mobil', 'public');
        }

        $mobil->save();

        return redirect()->route('mobil.index')->with('success', 'Data Berhasil Diperbarui!');
    }

    public function destroy($id)
    {
        Mobil::find($id)->delete();

        return redirect()->back()->with('success', 'Data Berhasil Dihapus!');
    }
}
