<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMutation extends Model
{
    use HasFactory;

    // Menentukan tabel yang digunakan oleh model ini
    protected $table = 'stock_mutations';

    // Menentukan kolom yang dapat diisi
    protected $fillable = [
        'item_id',
        'quantity_change',
        'mutation_type',
        'mutation_date',
        'user_id',
        'notes',
        'related_transaction_id',
    ];

    /**
     * Relasi dengan Item (many-to-one)
     * Setiap perubahan stok berhubungan dengan satu item
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    /**
     * Relasi dengan User (many-to-one)
     * Setiap perubahan stok dilakukan oleh seorang pengguna
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi dengan Transaction (many-to-one)
     * Setiap perubahan stok bisa terkait dengan satu transaksi
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'related_transaction_id');
    }
}
