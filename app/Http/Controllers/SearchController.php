<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kost; // Pastikan Anda mengimpor model Kost

class SearchController extends Controller
{
    /**
     * Menampilkan hasil pencarian kos.
     */
    public function index(Request $request)
    {
        $lokasi = $request->input('lokasi');

        $query = Kost::query();

        if ($lokasi) {
            $query->where('city', 'like', '%' . $lokasi . '%')
                  ->orWhere('address', 'like', '%' . $lokasi . '%');
        }

        // Anda bisa menambahkan filter lain di sini:
        // if ($request->has('type') && $request->type) {
        //     $query->where('type', $request->type);
        // }
        // if ($request->has('min_price') && $request->min_price) {
        //     $query->where('price', '>=', $request->min_price);
        // }

        $kosts = $query->paginate(10); // Paginasi 10 kos per halaman

        return view('pages.search.results', compact('kosts', 'lokasi'));
    }
}