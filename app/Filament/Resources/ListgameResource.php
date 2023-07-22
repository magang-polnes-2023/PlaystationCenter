<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ListgameResource\Pages;
use App\Filament\Resources\ListgameResource\RelationManagers;
use App\Filament\Resources\ListgameResource\RelationManagers\PlaystationsRelationManager;
use App\Models\Listgame;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use stdClass;

class ListgameResource extends Resource
{
    protected static ?string $model = Listgame::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static function getNavigationLabel(): string
    {
        return "Nama Game";
    }

    public static function getPluralLabel(): string
    {
        return "NamaGame";
    }

    protected static ?string $navigationGroup = 'Playstation Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('name')->required()
                            ->reactive()
                            ->afterStateUpdated(function (Closure $set, $state) {
                                $set('slug', \Str::slug($state));
                            })->required(),
                        TextInput::make('slug')->required()
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No')->getStateUsing(
                    static function (stdClass $rowLoop, HasTable $livewire): string {
                        return (string) ($rowLoop->iteration +
                            ($livewire->tableRecordsPerPage * ($livewire->page - 1
                            ))
                        );
                    }
                ),
                TextColumn::make('name')
                    ->searchable()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            PlaystationsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListListgames::route('/'),
            'create' => Pages\CreateListgame::route('/create'),
            'edit' => Pages\EditListgame::route('/{record}/edit'),
        ];
    }
}
