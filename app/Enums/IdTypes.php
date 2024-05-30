<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum IdTypes: string implements HasLabel
{
    case CC = 'cc';
    case TI = 'ti';
    case CE = 'ce';
    case RC = 'rc';
    case NIT = 'nit';
    case PP = 'pp';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::CC => 'Cédula de Ciudadanía',
            self::TI => 'Tarjeta de Identidad',
            self::CE => 'Cédula de Extranjería',
            self::RC => 'Registro Civil',
            self::NIT => 'NIT',
            self::PP => 'Pasaporte',
        };
    }
}