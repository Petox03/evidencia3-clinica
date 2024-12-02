<?php

namespace App\Filament\Widgets;

use App\Models\Pet;
use Filament\Widgets\ChartWidget;

class PetTypesCountWidget extends ChartWidget
{
    protected static ?string $heading = 'Conteo por tipos de mascotas';

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 1;

    protected static bool $isLazy = true;

    protected function getData(): array
    {
        // Obtener el conteo de mascotas por tipo
        $petTypesCount = Pet::selectRaw('pet_type_id, COUNT(*) as count')
            ->groupBy('pet_type_id')
            ->with('petType') // Asegúrate de tener la relación definida en el modelo Pet
            ->get();

        // Preparar los datos para el gráfico
        $labels = $petTypesCount->pluck('petType.type'); // Obtener los nombres de los tipos de mascota
        $data = $petTypesCount->pluck('count'); // Obtener los conteos

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Número de Mascotas',
                    'data' => $data,
                    'backgroundColor' => 'primary', // Color de las barras
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
