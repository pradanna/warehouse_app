<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    // Menentukan tabel yang digunakan oleh model ini
    protected $table = 'purchases';

    // Menentukan kolom yang dapat diisi
    protected $fillable = [
        'supplier_id',
        'purchase_date',
        'total_amount',
        'payment_status',
        'status',
        'receipt_image',
    ];

    /**
     * Relasi dengan Supplier (many-to-one)
     * Setiap purchase berhubungan dengan satu supplier
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * Relasi dengan PurchaseItem (one-to-many)
     * Setiap purchase memiliki banyak purchase_item
     */
    public function purchaseItems()
    {
        return $this->hasMany(PurchaseItem::class);
    }
}
