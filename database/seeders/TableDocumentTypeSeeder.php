<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TableDocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $documentTypes = [
            ['code' => 'CC', 'description' => 'Cédula de Ciudadanía'],
            ['code' => 'CE', 'description' => 'Cédula de Extranjería'],
            ['code' => 'TI', 'description' => 'Tarjeta de Identidad'],
            ['code' => 'PA', 'description' => 'Pasaporte'],
            ['code' => 'RC', 'description' => 'Registro Civil'],
        ];

        foreach ($documentTypes as $documentType) {
            DocumenType::updateOrCreate([
                'code' => $documentType['code']
            ],
                [
                    'description' => $documentType['description']
                ]);
        }
    }
}
