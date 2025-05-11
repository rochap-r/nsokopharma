<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenantInventory extends Model
{
    protected $fillable = [
        'tenant_id',
        'product_id',
        'price',
        'quantity',
        'custom_aisle_id'
    ];

    // Lien vers le produit dans la bibliothèque globale
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Emplacement personnalisé défini par le tenant
    public function customAisle()
    {
        return $this->belongsTo(Aisle::class, 'custom_aisle_id');
    }
}
