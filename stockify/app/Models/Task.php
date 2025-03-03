<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status', // Pending, In Progress, Done
        'user_id', // User yang mengerjakan tugas
        'created_by',

    ];

    /**
     * Relasi ke model User (Staff Gudang yang mengerjakan tugas).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke model Report (Setiap tugas yang selesai masuk ke laporan).
     */
    public function report()
    {
        return $this->hasOne(Report::class);
    }
}
