<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'log_type',
        'log_description',
        'reference_id'
    ];

    /**
     * Relasi dengan tabel User (pengguna yang membuat log).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Fungsi untuk mencatat aktivitas log.
     */
    public static function createLog($userId, $logType, $logDescription, $referenceId = null)
    {
        return self::create([
            'user_id' => $userId,
            'log_type' => $logType,
            'log_description' => $logDescription,
            'reference_id' => $referenceId,
        ]);
    }
}
