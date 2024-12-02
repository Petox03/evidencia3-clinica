<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use App\Models\Pet;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PetRelationManager extends RelationManager
{
    protected static string $relationship = 'pets';

    protected static ?string $title = 'Mascotas';
    protected static ?string $modelLabel = "Mascota";
    protected static ?string $pluralModelLabel = 'Mascotas';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
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
                    ])
                    ->columns(3)
                    ->columnSpan(2)
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('customer_id')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->label('Nombre'),
                Tables\Columns\TextColumn::make('pettype.type')
                ->label('Tipo de Mascota'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Añadir Mascota'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('Editar')
                    ->icon('heroicon-m-pencil-square')
                    ->url(fn (Pet $record): string => url('pets/' . $record->id . '/edit')),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
