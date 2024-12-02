<?php

namespace App\Filament\Resources\PetResource\RelationManagers;

use App\Models\Medicine;
use App\Models\Treatment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Tables\Actions\Action as ActionsAction;
use Filament\Notifications\Notification;

class TreatmentRelationManager extends RelationManager
{
    protected static string $relationship = 'Treatments';

    protected static ?string $modelLabel = "Tratamiento";
    protected static ?string $pluralModelLabel = "Tratamientos";

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('medicine_id')
                    ->label('Medicina')
                    ->searchable()
                    ->relationship(name: 'medicine', titleAttribute: 'name')
                    ->loadingMessage('Cargando medicinas...')
                    ->preload()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->label('Nombre')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->required(),

                Forms\Components\TextInput::make('dose')
                ->label('Dosis')
                ->numeric()
                ->minValue(1)
                ->required(),

                Forms\Components\TimePicker::make('administration_time')
                ->seconds(false)
                ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('pet_id')
            ->columns([
                Tables\Columns\TextColumn::make('medicine.name')
                    ->label('Medicina'),

                Tables\Columns\TextColumn::make('medicine.administration')
                    ->label('Vía de adminsitración'),

                Tables\Columns\TextColumn::make('dose')
                    ->label('Dosis'),

                Tables\Columns\TextColumn::make('administration_time')
                    ->label('Hora de adminsitración'),

                Tables\Columns\ToggleColumn::make('is_in_treatment')
                    ->label('En tratamiento'),



            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                ActionsAction::make('Administrar')->icon('heroicon-m-bolt')->color('info')->action(function (Treatment $record) {
                    $medicine = $record->medicine;
                    if($record->is_in_treatment) {
                        if ($medicine->amount >= $record->dose) {
                            $medicine->amount -= $record->dose;
                            $medicine->save();
                            Notification::make()->title('Medicina Administrada')->body('La dosis ha sido administrada correctamente y el stock ha sido actualizado.')->success()->send();
                        } else {
                            Notification::make()->title('No hay suficientes unidades')->body('Por favor, notificar al tutor para suministrarlo nuevamente.')->duration(5000)->danger()->send();
                        }
                    }
                    else {
                        Notification::make()->title('No se puede administrar')->body('El medicamento se ha retirado de los tratamientos.')->duration(5000)->danger()->send();
                    }
                }),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
