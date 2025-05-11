<?php

namespace App\Models;

use App\Enums\PersonType;
use App\Enums\ProductType;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'dci',
        'dosage',
        'forme_galenique',
        'type',
        'personne',
        'category_id',
        'aisle_id'
    ];

    // On cast automatiquement les colonnes vers nos Enum
    protected $casts = [
        'type' => ProductType::class,
        'personne' => PersonType::class,
    ];

    // Relation avec sa catégorie
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Emplacement (aisle)
    public function aisle()
    {
        return $this->belongsTo(Aisle::class, 'aisle_id');
    }

    // Inventaires des tenants qui utilisent ce produit
    public function tenantInventories()
    {
        return $this->hasMany(TenantInventory::class);
    }
}
