<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum ApplicationRole: string implements HasLabel
{
    case Admin = 'admin';
    case Support = 'support';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Admin => 'Administrador',
            self::Support => 'Soporte',
        };
    }
}
