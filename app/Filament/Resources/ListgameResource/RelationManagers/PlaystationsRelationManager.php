<?php

namespace App\Filament\Resources\ListgameResource\RelationManagers;

use App\Filament\Resources\PlaystationResource;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlaystationsRelationManager extends RelationManager
{
    protected static string $relationship = 'playstations';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return PlaystationResource::form($form);
    }

    public static function table(Table $table): Table
    {
        return PlaystationResource::table($table)
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }    
}
