<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Mengatur kolom yang dapat diisi (fillable)
    protected $fillable = [
        'id',
        'outlet_id',
        'date',
        'total_amount',
        'payment_status',
        'status',
    ];

    // Menentukan tipe data untuk kolom UUID
    protected $keyType = 'string';
    public $incrementing = false;

    // Mengatur format tanggal
    protected $dates = [
        'date',
        'created_at',
        'updated_at',
    ];

    /**
     * Relasi dengan outlet (satu transaksi milik satu outlet)
     */
    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }

    /**
     * Menentukan status pembayaran dalam format yang lebih mudah diakses
     */
    public function getPaymentStatusLabelAttribute()
    {
        $statusLabels = [
            'paid' => 'Paid',
            'unpaid' => 'Unpaid',
            'partial' => 'Partial',
        ];

        return $statusLabels[$this->payment_status] ?? 'Unknown';
    }

    /**
     * Menentukan status transaksi dalam format yang lebih mudah diakses
     */
    public function getStatusLabelAttribute()
    {
        $statusLabels = [
            'pending' => 'Pending',
            'completed' => 'Completed',
            'canceled' => 'Canceled',
        ];

        return $statusLabels[$this->status] ?? 'Unknown';
    }

    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class);
    }
}
