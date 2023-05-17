<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Models\Role;

class Roles extends Role
{
    // use HasFactory, HasRoles, HasPermissions;

    protected $guard_name = '';

    public function user(): HasMany 
    {
        return $this->hasMany(User::class);
    }
    
}
