<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kosts extends Model // Ubah dari Kosts menjadi Kost
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'description',
        'address',
        'city',
        'price',
        'type',
        'facilities',
        'images',
        'latitude',
        'longitude',
        'owner_phone',
        'owner_whatsapp',
    ];

    protected $casts = [
        'facilities' => 'array',
        'image' => 'array',
        'price' => 'decimal:0',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
