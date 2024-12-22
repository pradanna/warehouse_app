<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    // Menentukan tabel yang digunakan oleh model ini
    protected $table = 'payments';

    // Menentukan kolom yang dapat diisi
    protected $fillable = [
        'transaction_id',
        'amount',
        'payment_status',
        'payment_method',
        'payment_proof',
    ];

    /**
     * Relasi dengan Transaction (many-to-one)
     * Setiap pembayaran berhubungan dengan satu transaksi
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
