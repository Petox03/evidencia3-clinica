<?php

namespace App\Filament\Widgets;

use App\Models\Customer;
use App\Models\Pet;
use App\Models\Treatment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TreatmentsCountWidget extends BaseWidget
{
    public $count;

    public function mount()
    {
        // Contar los tratamientos no finalizados
        $this->count = Treatment::where('is_in_treatment', true)->count();
    }

    protected function getStats(): array
    {
        $petsCount = Pet::count();
        $customersCount = Customer::count();

        return [
            Stat::make('Tratamientos', $this->count)
                ->description('Cantidad de tratamientos sin completar')
                ->descriptionIcon('heroicon-o-beaker'),

            Stat::make('Mascotas', $petsCount)
                ->description('Cantidad de mascotas registradas')
                ->descriptionIcon('heroicon-o-star'),

            Stat::make('Clientes', $customersCount)
                ->description('Cantidad de clientes registrados')
                ->descriptionIcon('heroicon-o-user-group')
        ];
    }
}