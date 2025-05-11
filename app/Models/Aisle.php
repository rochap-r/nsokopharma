<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aisle extends Model
{
    protected $fillable = ['code', 'category_id'];

    // Lien vers une catégorie (optionnel)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Produits dont l’emplacement recommandé est cet aisle
    public function products()
    {
        return $this->hasMany(Product::class, 'aisle_id');
    }

    // Inventaires de tenants utilisant cet aisle en emplacement personnalisé
    public function tenantInventories()
    {
        return $this->hasMany(TenantInventory::class, 'custom_aisle_id');
    }

}
