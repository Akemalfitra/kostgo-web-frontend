<?php

namespace App\Http\Controllers;
use App\Models\Kosts;

class KostController extends Controller
{
    public function show($slug)
    {
        // Karena kita sudah mendefinisikan $casts di model Kost (facilities dan images sebagai array),
        // Laravel akan secara otomatis mengonversi string JSON dari database menjadi array PHP.
        // Jadi, Anda tidak perlu lagi melakukan json_decode() secara manual di sini. 

        $kost = Kosts::where('slug', $slug)->first(); // Gunakan first() untuk mengambil satu record

        // Jika kost tidak ditemukan, Anda bisa mengarahkan ke 404 atau halaman lain
        if (!$kost) {
            abort(404, 'Kos tidak ditemukan.');
        }

        return view('kost.show', compact('kost'));
    }
}
