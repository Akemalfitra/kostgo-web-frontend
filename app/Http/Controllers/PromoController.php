<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kosts; // Kita akan pakai model Kost untuk promo juga

class PromoController extends Controller
{
    public function index()
    {
        // Di sini Anda bisa menambahkan logika untuk mengambil kos yang sedang promo
        // Misalnya, menambahkan kolom 'is_promo' di tabel kosts, atau tabel 'promos' terpisah
        // Untuk demo ini, kita akan ambil semua kos sebagai contoh promo
        $promos = Kosts::paginate(12);

        return view('pages.promos.index', compact('promos'));
    }
}