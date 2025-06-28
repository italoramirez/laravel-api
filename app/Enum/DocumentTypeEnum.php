<?php

namespace App\Enum;

enum DocumentTypeEnum: string implements  EnumInterface
{
    case CC = 'CCE';
    case CE = 'CEX';
    case TI = 'TID';
    case NIT = 'NIT';
    case PASSPORT = 'PAS';

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

    /**
     * @return array
     */
    public static function getDocumentType(): array
    {
        $result = [];
        foreach (self::cases() as $index => $value) {
            $result[] = [
//                'id' => $index + 1,
                'code' => $value->value,
                'description' => $value->description()
            ];
        }
        return $result;
    }

}
