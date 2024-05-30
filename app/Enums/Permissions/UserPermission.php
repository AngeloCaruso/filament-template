<?php

namespace App\Enums\Permissions;

use Filament\Support\Contracts\HasLabel;

enum UserPermission: string implements HasLabel
{
    public const Prefix = 'user.';

    case ViewAny = 'user.view-any';
    case View = 'user.view';
    case Create = 'user.create';
    case Update = 'user.update';
    case Delete = 'user.delete';
    case Restore = 'user.restore';
    case ForceDelete = 'user.force-delete';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::ViewAny => 'Ver usuarios',
            self::View => 'Ver usuario',
            self::Create => 'Crear usuario',
            self::Update => 'Actualizar usuario',
            self::Delete => 'Eliminar usuario',
            self::Restore => 'Restaurar usuario',
            self::ForceDelete => 'Eliminar permanentemente usuario',
        };
    }
}
