<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    // Menentukan nama tabel jika tidak mengikuti konvensi Laravel (tabel 'items')
    protected $table = 'items';

    // Kolom yang dapat diisi massal (fillable)
    protected $fillable = [
        'id',
        'name',
        'sku',
        'description',
        'unit',
        'category_id',
        'price1',
        'price2',
        'purchase_price',
        'current_stock',
        'min_stock',
        'max_stock',
        'status'
    ];

    // Relasi ke model Category (banyak ke 1)
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class);
    }
}
