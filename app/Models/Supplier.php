<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'id',
        'name',
        'contact_person',
        'email',
        'phone',
        'address',
    ];

    // Menentukan tipe data untuk kolom UUID
    protected $keyType = 'string';
    public $incrementing = false;

    // Mengatur format tanggal
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * Akses untuk mendapatkan nama supplier dan informasi kontak
     */
    public function getSupplierInfoAttribute()
    {
        return $this->name . ' (' . ($this->contact_person ?? 'No Contact') . ')';
    }
}
