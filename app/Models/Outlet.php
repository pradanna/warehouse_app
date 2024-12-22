<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;

    protected $table = 'outlets';

    protected $fillable = [
        'id',
        'name',
        'owner_type',
        'address',
        'contact',
        'status'
    ];

    // Relasi ke transaksi (1 ke banyak)
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'outlet_id');
    }
}
