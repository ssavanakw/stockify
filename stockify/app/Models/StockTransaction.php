<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['material_id', 'type', 'quantity', 'price', 'transaction_date', 'description'];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

}
