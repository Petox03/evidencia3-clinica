<?php

namespace App\Filament\Resources\PetTypeResource\Pages;

use App\Filament\Resources\PetTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePetType extends CreateRecord
{
    protected static string $resource = PetTypeResource::class;
}
