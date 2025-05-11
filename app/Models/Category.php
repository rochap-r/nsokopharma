<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'parent_id'];

    // Relation vers la catégorie parente
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Relations vers les sous-catégories
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Produits appartenant à cette catégorie
    public function products()
    {
        return $this->hasMany( Product::class);
    }

    // Aisles associés à cette catégorie (optionnel pour des recommandations)
    public function aisles()
    {
        return $this->hasMany(Aisle::class);
    }
}
