<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'material_id', 
        'user_id',
        'type', 
        'quantity', 
        'price', 
        'transaction_date', 
        'description'
    ];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function user()  // ✅ Add this relationship
    {
        return $this->belongsTo(User::class);
    }

    public function getTransactionTypeAttribute($value)
    {
        return $value === 'in' ? 'Stock In' : 'Stock Out';
    }

}
