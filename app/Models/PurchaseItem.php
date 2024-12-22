<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    use HasFactory;

    // Menentukan tabel yang digunakan oleh model ini
    protected $table = 'purchase_items';

    // Menentukan kolom yang dapat diisi
    protected $fillable = [
        'purchase_id',
        'item_id',
        'quantity',
        'price',
        'total',
    ];

    /**
     * Relasi dengan Purchase (many-to-one)
     * Setiap purchase_item berhubungan dengan satu purchase
     */
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    /**
     * Relasi dengan Item (many-to-one)
     * Setiap purchase_item berhubungan dengan satu item
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
