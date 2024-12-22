<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'id',
        'transaction_id',
        'item_id',
        'quantity',
        'price',
        'total',
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
     * Relasi ke model Transaction (Satu transaksi dapat memiliki banyak item)
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    /**
     * Relasi ke model Item (Satu item bisa ada di banyak transaksi)
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    /**
     * Akses untuk menghitung total harga berdasarkan quantity dan price
     */
    public function calculateTotal()
    {
        return $this->quantity * $this->price;
    }
}
