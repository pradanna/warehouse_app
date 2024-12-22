<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Menentukan nama tabel jika tidak mengikuti konvensi Laravel (tabel 'categories')
    protected $table = 'categories';

    // Kolom yang dapat diisi massal (fillable)
    protected $fillable = [
        'id',
        'name',
        'description'
    ];

    // Relasi ke model Item (1 ke banyak)
    public function items()
    {
        return $this->hasMany(Item::class, 'category_id');
    }
}
