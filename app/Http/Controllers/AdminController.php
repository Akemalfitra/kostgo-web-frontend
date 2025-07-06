<?php

namespace App\Http\Controllers;

use App\Models\Kosts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index()
    {
        // Asumsi ada kolom 'user_id' di tabel 'kosts' untuk mengidentifikasi pemilik
        // Jika tidak ada, Anda perlu menambahkan kolom ini atau menyesuaikan logika otorisasi
        $userId = auth()->id(); // Mendapatkan ID pengguna yang sedang login

        // Mengambil semua kos yang dimiliki oleh pengguna saat ini
        $myKosts = Kosts::where('user_id', $userId)->get();

        // Menghitung statistik (ini bisa disesuaikan lebih lanjut dengan relasi kamar jika ada)
        $totalKosts = $myKosts->count();
        // Untuk total kamar dan kamar tersedia, Anda perlu memiliki model Room
        // dan relasi di model Kost (misal: hasMany(Room::class))
        $totalRooms = 0; // Contoh: $myKosts->sum(function($kost) { return $kost->rooms->count(); });
        $availableRooms = 0; // Contoh: $myKosts->sum(function($kost) { return $kost->rooms->where('is_available', true)->count(); });

        // Dummy data untuk booking pending, Anda perlu mengadaptasinya dengan model Booking Anda
        $pendingBookings = 2; // Contoh: Booking::where('owner_id', $userId)->where('status', 'pending')->count();

        return view('dashboard-admin', compact('myKosts', 'totalKosts', 'totalRooms', 'availableRooms', 'pendingBookings'));
    }

    public function create()
    {
        return view('kost.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'type' => 'required|in:putra,putri,campur',
            'facilities' => 'nullable|array', // Array of strings
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi setiap file gambar
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'owner_phone' => 'nullable|string|max:255',
            'owner_whatsapp' => 'nullable|string|max:255',
        ]);

        $imagePaths = []; // Inisialisasi array untuk menyimpan path semua gambar
        if ($request->hasFile('images')) {
            // Hanya ambil gambar pertama jika ada banyak, atau gambar tunggal
            $uploadedImages = $request->file('images');
            $imageToStore = is_array($uploadedImages) ? $uploadedImages[0] : $uploadedImages;

            if ($imageToStore) {
                // Simpan file ke public/kosts dan dapatkan path relatif dari public
                $path = $imageToStore->store('public/kosts'); // Path akan seperti 'public/kosts/namafile.png'
                $imagePaths[] = Str::after($path, 'public/'); // Ambil 'kosts/namafile.png'
            }
        }

        // Buat slug dari nama kos
        $slug = Str::slug($request->name);

        // Simpan data kos
        $kost = Kosts::create([ // Menggunakan Kosts sesuai model Anda
            'user_id' => auth()->id(),
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'address' => $request->address,
            'city' => $request->city,
            'price' => $request->price,
            'type' => $request->type,
            'facilities' => json_encode($request->facilities),
            'images' => json_encode($imagePaths), // Simpan array path gambar sebagai JSON string di kolom 'images'
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'owner_phone' => $request->owner_phone,
            'owner_whatsapp' => $request->owner_whatsapp,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Kos berhasil ditambahkan!');
    }

    public function edit(Kosts $kost)
    {
        // Pastikan pengguna memiliki hak akses untuk mengedit kos ini
        if (auth()->id() !== $kost->user_id) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('kost.edit', compact('kost'));
    }

    public function update(Request $request, Kosts $kost)
    {
        // Pastikan pengguna memiliki hak akses untuk memperbarui kos ini
        if (auth()->id() !== $kost->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'type' => 'required|in:putra,putri,campur',
            'facilities' => 'nullable|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'owner_phone' => 'nullable|string|max:255',
            'owner_whatsapp' => 'nullable|string|max:255',
            'existing_images' => 'nullable|array', // Untuk gambar yang sudah ada dan tidak dihapus
            'existing_images.*' => 'string',
        ]);

        $currentImages = json_decode($kost->images, true) ?? [];
        $updatedImages = $request->input('existing_images', []); // Gambar yang dipertahankan

        // Hapus gambar lama yang tidak ada di existing_images
        foreach ($currentImages as $image) {
            if (!in_array($image, $updatedImages)) {
                Storage::delete(Str::after($image, '/storage/')); // Hapus dari storage
            }
        }

        // Upload gambar baru
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('public/images');
                $updatedImages[] = Storage::url($path);
            }
        }

        $slug = Str::slug($request->name);

        $kost->update([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'address' => $request->address,
            'city' => $request->city,
            'price' => $request->price,
            'type' => $request->type,
            'facilities' => json_encode($request->facilities),
            'image' => $updatedImages,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'owner_phone' => $request->owner_phone,
            'owner_whatsapp' => $request->owner_whatsapp,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Kos berhasil diperbarui!');
    }

    public function destroy(Kosts $kost)
    {
        // Pastikan pengguna memiliki hak akses untuk menghapus kos ini
        if (auth()->id() !== $kost->user_id) {
            abort(403, 'Unauthorized action.');
        }

        // Hapus gambar terkait sebelum menghapus data kos
        $images = json_decode($kost->images, true) ?? [];
        foreach ($images as $image) {
            Storage::delete(Str::after($image, '/storage/'));
        }

        $kost->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Kos berhasil dihapus!');
    }

    public function rooms(Kosts $kost)
    {
        // Pastikan pengguna memiliki hak akses untuk melihat kamar kos ini
        if (auth()->id() !== $kost->user_id) {
            abort(403, 'Unauthorized action.');
        }

        // Anda akan mengisi ini dengan logika untuk menampilkan dan mengelola kamar
        // Contoh: return view('kosts.rooms', compact('kost'));
        return redirect()->route('admin.dashboard')->with('info', 'Fitur manajemen kamar belum diimplementasikan.');
    }
}
