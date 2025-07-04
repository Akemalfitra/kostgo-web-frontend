<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kost; // Kita akan pakai model Kost untuk promo juga

class PromoController extends Controller
{
    public function index()
    {
        // Di sini Anda bisa menambahkan logika untuk mengambil kos yang sedang promo
        // Misalnya, menambahkan kolom 'is_promo' di tabel kosts, atau tabel 'promos' terpisah
        // Untuk demo ini, kita akan ambil semua kos sebagai contoh promo
        $promos = Kost::paginate(12); // Ambil semua kos dengan paginasi

        return view('pages.promos.index', compact('promos'));
    }
}