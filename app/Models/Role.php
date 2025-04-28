<?php

namespace App\Models;


use Spatie\Permission\Models\Role as BaseRole;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Role extends BaseRole
{
    use  BelongsToTenant;
    // Ajoutez ici vos colonnes ou méthodes personnalisées
    protected $fillable = ['name','guard_name', 'tenant_id'];
}
