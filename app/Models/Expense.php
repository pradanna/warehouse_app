<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'expense_type',
        'description',
        'payment_method',
        'date',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
