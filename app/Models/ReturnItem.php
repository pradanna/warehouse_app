<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ReturnItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'quantity',
        'return_type',
        'transaction_id',
        'purchase_id',
        'return_date',
        'reason',
        'user_id',
        'notes'
    ];

    /**
     * Relasi dengan tabel Item.
     */
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    /**
     * Relasi dengan tabel Transaction.
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }

    /**
     * Relasi dengan tabel Purchase.
     */
    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }

    /**
     * Relasi dengan tabel User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Fungsi untuk mengelola retur ke Warehouse.
     */
    public function returnToWarehouse($itemId, $quantity)
    {
        $item = Item::findOrFail($itemId);
        $item->quantity += $quantity;  // Menambah stok barang yang dikembalikan
        $item->save();

        // Menyimpan catatan retur
        return self::create([
            'item_id' => $itemId,
            'quantity' => $quantity,
            'return_type' => 'warehouse', // Retur ke warehouse
            'transaction_id' => null, // Tidak ada transaksi terkait
            'purchase_id' => null, // Tidak ada pembelian terkait
            'return_date' => now(),
            'reason' => 'Barang rusak atau tidak terjual',
            'user_id' => Auth::id(),
            'notes' => 'Pengembalian barang dari outlet ke warehouse',
        ]);
    }

    /**
     * Fungsi untuk mengelola retur ke Supplier.
     */
    public function returnToSupplier($itemId, $quantity, $purchaseId)
    {
        $item = Item::findOrFail($itemId);
        $item->quantity += $quantity;  // Menambah stok barang yang dikembalikan
        $item->save();

        // Menyimpan catatan retur
        return self::create([
            'item_id' => $itemId,
            'quantity' => $quantity,
            'return_type' => 'supplier', // Retur ke supplier
            'purchase_id' => $purchaseId, // ID pembelian terkait
            'return_date' => now(),
            'reason' => 'Barang cacat atau tidak sesuai pesanan',
            'user_id' => Auth::id(),
            'notes' => 'Pengembalian barang ke supplier',
        ]);
    }
}
