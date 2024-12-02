<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PetTypeResource\Pages;
use App\Filament\Resources\PetTypeResource\RelationManagers;
use App\Models\PetType;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class PetTypeResource extends Resource
{
    protected static ?string $model = PetType::class;

    protected static ?string $navigationLabel = 'Tipos de Mascota';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = "Tipo";
    protected static ?string $pluralModelLabel = "Tipos";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->schema([
                        Section::make('')
                            ->schema([
                                TextInput::make('type')
                                ->label('Tipo')
                            ->required()
                            ->maxLength(255),
                            ])
                            ->columns(1),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('type')
                    ->sortable()
                    ->label('Tipo'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Creado'),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Editado'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Editar'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPetTypes::route('/'),
            'create' => Pages\CreatePetType::route('/create'),
            'edit' => Pages\EditPetType::route('/{record}/edit'),
        ];
    }
}
