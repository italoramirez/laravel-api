<?php

namespace App\Enum;

enum CategoriesEnum: string implements EnumInterface
{
    case COMIDA = 'COM';
    case ASEO = 'ASE';
    case ELECTRONICA = 'ELE';
    case ROPA = 'ROP';

    /**
     * @return string
     */
    function description(): string
    {
        return match ($this) {
            self::COMIDA => 'Comida',
            self::ASEO => 'Aseo',
            self::ELECTRONICA => 'Electrónica',
            self::ROPA => 'Ropa'
        };
    }

    public function getCategories(): array
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
