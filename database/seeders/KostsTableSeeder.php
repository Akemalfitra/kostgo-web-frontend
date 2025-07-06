<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kosts;
use Illuminate\Support\Str;

class KostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kosts::truncate();
        $kosts = [
            [
                'user_id' => 2,
                'name' => 'Kos Melati Bandung',
                'slug' => Str::slug('Kos Melati Bandung'),
                'description' => 'Kos nyaman untuk putri dengan fasilitas lengkap di pusat kota Bandung. Dekat ITB.',
                'address' => 'Jl. Melati Raya No. 10',
                'city' => 'Bandung',
                'type' => 'putri',
                'price' => 1200000,
                'facilities' => json_encode(['AC', 'Kamar Mandi Dalam', 'WiFi', 'Meja Belajar']),
                'image' => json_encode(['kosts/aury.png', 'kosts/bandasakti.png']), // Menggunakan gambar Anda
                'latitude' => -6.917464,
                'longitude' => 107.619123,
                'owner_phone' => '081234567890',
                'owner_whatsapp' => '6281234567890',
            ],
            [
                'user_id' => 2,
                'name' => 'Kost Putra Ganesha',
                'slug' => Str::slug('Kost Putra Ganesha'),
                'description' => 'Kos khusus putra dekat kampus ITB dan UNPAD. Lingkungan aman dan tenang.',
                'address' => 'Jl. Ganesha No. 5',
                'city' => 'Bandung',
                'type' => 'putra',
                'price' => 1500000,
                'facilities' => json_encode(['Kipas Angin', 'Dapur Umum', 'Parkir Motor']),
                'image' => json_encode(['kosts/putraganesha.png']), // Menggunakan gambar Anda
                'latitude' => -6.890695,
                'longitude' => 107.610665,
                'owner_phone' => '087654321098',
                'owner_whatsapp' => '6287654321098',
            ],
            [
                'user_id' => 2,
                'name' => 'Kost Bestam',
                'slug' => Str::slug('Kost Bestam'),
                'description' => 'Kos campur modern dengan area komunal yang nyaman. Dekat pusat kota Lhokseumawe.',
                'address' => 'Jl. Haji Nafi No. 20',
                'city' => 'Lhokseumawe', // Mengubah ke Lhokseumawe
                'type' => 'campur',
                'price' => 2000000,
                'facilities' => json_encode(['AC', 'Kamar Mandi Dalam', 'Kasur', 'Lemari', 'Security 24 Jam']),
                'image' => json_encode(['kosts/bestam.png']), // Menggunakan gambar Anda
                'latitude' => 5.170392, // Koordinat Lhokseumawe
                'longitude' => 97.147153, // Koordinat Lhokseumawe
                'owner_phone' => '081122334455',
                'owner_whatsapp' => '6281122334455',
            ],
            [
                'user_id' => 2,
                'name' => 'Kos Putri Amanah Lhokseumawe',
                'slug' => Str::slug('Kos Putri Amanah Lhokseumawe'),
                'description' => 'Kos bersih dan nyaman di Lhokseumawe, cocok untuk mahasiswa atau pekerja putri. Dekat Universitas Malikussaleh.',
                'address' => 'Jl. Merdeka No. 1',
                'city' => 'Lhokseumawe',
                'type' => 'putri',
                'price' => 700000,
                'facilities' => json_encode(['Kipas Angin', 'Meja Belajar', 'Lemari', 'Parkir Luas']),
                'image' => json_encode(['kosts/tubacus.jpg']), // Menggunakan gambar Anda
                'latitude' => 5.170669,
                'longitude' => 97.147775,
                'owner_phone' => '085211223344',
                'owner_whatsapp' => '6285211223344',
            ],
            [
                'user_id' => 2,
                'name' => 'Kost Sejuk Depok',
                'slug' => Str::slug('Kost Sejuk Depok'),
                'description' => 'Kos sejuk dan tenang di Depok, dekat kampus UI dan Gunadarma. Banyak pilihan makanan di sekitar.',
                'address' => 'Jl. Raya Margonda No. 100',
                'city' => 'Depok',
                'type' => 'campur',
                'price' => 1000000,
                'facilities' => json_encode(['AC', 'Kamar Mandi Luar', 'Kasur', 'Meja Belajar', 'Lemari']),
                'image' => json_encode(['kosts/aury.png']), // Contoh, bisa diganti jika ada gambar kelima
                'latitude' => -6.368688,
                'longitude' => 106.837833,
                'owner_phone' => '081987654321',
                'owner_whatsapp' => '6281987654321',
            ],
             [
                'user_id' => 2,
                'name' => 'Kost Indah Surabaya',
                'slug' => Str::slug('Kost Indah Surabaya'),
                'description' => 'Kos baru di Surabaya, bersih dan nyaman, dekat pusat perbelanjaan.',
                'address' => 'Jl. Kenjeran No. 50',
                'city' => 'Surabaya',
                'type' => 'putri',
                'price' => 1300000,
                'facilities' => json_encode(['AC', 'Kamar Mandi Dalam', 'WiFi']),
                'image' => json_encode(['kosts/indah.png']),
                'latitude' => -7.257472,
                'longitude' => 112.752077,
                'owner_phone' => '082122334455',
                'owner_whatsapp' => '6282122334455',
            ],
            [
                'user_id' => 2,
                'name' => 'Kost Nyaman Yogyakarta',
                'slug' => Str::slug('Kost Nyaman Yogyakarta'),
                'description' => 'Kos aman dan nyaman di Jogja, dekat UGM dan UNY.',
                'address' => 'Jl. Kaliurang Km. 5',
                'city' => 'Yogyakarta',
                'type' => 'campur',
                'price' => 950000,
                'facilities' => json_encode(['Kipas Angin', 'Dapur Bersama']),
                'image' => json_encode(['kosts/nyaman.png']),
                'latitude' => -7.782806,
                'longitude' => 110.370529,
                'owner_phone' => '081344556677',
                'owner_whatsapp' => '6281344556677',
            ],
            [
                'user_id' => 2,
                'name' => 'Kos Mewah Jakarta',
                'slug' => Str::slug('Kos Mewah Jakarta'),
                'description' => 'Kos eksklusif di Jakarta Selatan, fasilitas premium, cocok untuk pekerja profesional.',
                'address' => 'Jl. Sudirman No. 1',
                'city' => 'Jakarta',
                'type' => 'putra',
                'price' => 3500000,
                'facilities' => json_encode(['AC', 'Kamar Mandi Dalam', 'TV Kabel', 'Kolam Renang']),
                'image' => json_encode(['kosts/mewah.png']),
                'latitude' => -6.208763,
                'longitude' => 106.845599,
                'owner_phone' => '081299887766',
                'owner_whatsapp' => '6281299887766',
            ],
        ];

        foreach ($kosts as $kost) {
            Kosts::create($kost);
        }
    }
}