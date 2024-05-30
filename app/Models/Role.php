<?php

namespace App\Models;

use App\Enums\ApplicationRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($role) {
            $role->guard_name = $role->guard_name ?: 'web'; // Set a default guard name
        });
    }
}
