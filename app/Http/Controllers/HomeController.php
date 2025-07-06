<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kosts;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil 4 kos acak untuk popular
        $popularKosts = Kosts::inRandomOrder()->limit(4)->get();

        // Mengambil 6 kos acak untuk promo
        $promoKosts = Kosts::inRandomOrder()->limit(6)->get();

        // Kirim data ke view
        return view('welcome', compact('popularKosts', 'promoKosts'));
    }
}