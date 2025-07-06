<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kost; // Pastikan Anda mengimpor model Kost

class HomeController extends Controller
{
    public function index()
    {
        // Anda bisa mengambil data kos populer di sini jika dibutuhkan di halaman utama
        // Untuk saat ini, kita biarkan saja menampilkan view welcome
        return view('welcome'); // Ganti dengan view yang sesuai
    }
}