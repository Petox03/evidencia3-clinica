<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PetResource\Pages;
use App\Filament\Resources\PetResource\RelationManagers;
use App\Models\Pet;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PetResource extends Resource
{
    protected static ?string $model = Pet::class;

    protected static ?string $navigationLabel = 'Mascotas';

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?string $modelLabel = "Mascota";
    protected static ?string $pluralModelLabel = "Mascotas";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nombre')
                                    ->required(),

                                Forms\Components\Select::make('pet_type_id')
                                    ->label('Tipo de Mascota')
                                    ->searchable()
                                    ->relationship(name: 'petType', titleAttribute: 'type')
                                    ->loadingMessage('Cargando tipos...')
                                    ->preload()
                                    ->createOptionForm([
                                        Forms\Components\TextInput::make('type')
                                                    ->label('Tipo')
                                                    ->required()
                                                    ->maxLength(255),
                                    ])
                                    ->validationMessages([
                                        'required' => 'Es necesario seleccionar un tipo de mascota.'
                                    ])
                                    ->required(),

                                Forms\Components\TextInput::make('age')
                                    ->label('Edad')
                                    ->required()
                                    ->numeric()
                                    ->minValue(0),

                                Forms\Components\Select::make('customer_id')
                                    ->label('Dueño')
                                    ->searchable()
                                    ->relationship(name: 'customer', titleAttribute: 'name')
                                    ->loadingMessage('Cargando tipos...')
                                    ->preload()
                                    ->createOptionForm([
                                        Forms\Components\TextInput::make('type')
                                                    ->label('Tipo')
                                                    ->required()
                                                    ->maxLength(255),
                                    ])
                                    ->validationMessages([
                                        'required' => 'Es necesario seleccionar un dueño.'
                                    ])
                                    ->required(),
                            ])
                            ->columns(2),
                    ])
                    ->columnSpan(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Nombre'),
                Tables\Columns\TextColumn::make('pettype.type')
                    ->sortable()
                    ->label('Tipo de Mascota'),
                Tables\Columns\TextColumn::make('age')
                    ->numeric()
                    ->sortable()
                    ->label('Edad'),
                Tables\Columns\TextColumn::make('customer.name')
                    ->numeric()
                    ->sortable()
                    ->searchable()
                    ->label('Cliente'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Creado')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Actualizado')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ToggleColumn::make('is_hospitalized')
                    ->label('Internado'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\TreatmentRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPets::route('/'),
            'create' => Pages\CreatePet::route('/create'),
            'edit' => Pages\EditPet::route('/{record}/edit'),
        ];
    }
}
