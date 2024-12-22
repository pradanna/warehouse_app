<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryAdjustment extends Model
{
    use HasFactory;

    // Menentukan tabel yang digunakan oleh model ini
    protected $table = 'inventory_adjustments';

    // Menentukan kolom yang dapat diisi
    protected $fillable = [
        'item_id',
        'adjustment_qty',
        'adjustment_type',
        'reason',
        'user_id',
    ];

    /**
     * Relasi dengan Item (many-to-one)
     * Setiap inventory adjustment berhubungan dengan satu item
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    /**
     * Relasi dengan User (many-to-one)
     * Setiap inventory adjustment berhubungan dengan satu user (yang melakukan penyesuaian)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
