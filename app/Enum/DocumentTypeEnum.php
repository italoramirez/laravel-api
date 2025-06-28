<?php

namespace App\Enum;

enum DocumentTypeEnum: string implements  EnumInterface
{
    case CC = 'CC';
    case CE = 'CE';
    case TI = 'TI';
    case NIT = 'NIT';
    case PASSPORT = 'PASSPORT';

    /**
     * @return string
     */
    function description(): string
    {
        return match ($this) {
            self::CC => 'Cédula de Ciudadanía',
            self::CE => 'Cédula de Extranjería',
            self::TI => 'Tarjeta de Identidad',
            self::NIT => 'Número de Identificación Tributaria',
            self::PASSPORT => 'Pasaporte'
        };
    }
    public static function getDocumentType(): array
    {
        $result = [];
        foreach (self::cases() as $index => $value) {
            $result[] = [
                'id' => $index + 1,
                'code' => $value->value,
                'description' => $value->description()
            ];
        }
        return $result;
    }

}
