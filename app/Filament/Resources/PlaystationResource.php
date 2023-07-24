<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlaystationResource\Pages;
use App\Filament\Resources\PlaystationResource\RelationManagers;
use App\Models\Playstation;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use stdClass;

class PlaystationResource extends Resource
{
    protected static ?string $model = Playstation::class;

    protected static ?string $navigationIcon = 'heroicon-o-play';

    protected static function getNavigationLabel(): string
    {
        return "Playstation";
    }

    public static function getPluralLabel(): string
    {
        return "Playstation";
    }

    protected static ?string $navigationGroup = 'Playstation Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('name')
                            ->required(),
                        FileUpload::make('image')
                            ->required(),
                        Select::make('playstation_type')
                            ->options([
                                'Playstation 3' => 'Playstation 3',
                                'Playstation 4' => 'Playstation 4',
                                'Playstation 5' => 'Playstation 5',
                            ])->label('Jenis Playstation')->required(),
                        CheckboxList::make('listgame')
                            ->relationship('listgame', 'name')
                            ->required(),
                        Textarea::make('desc')
                            ->required(),
                        TextInput::make('price')
                            ->label('Harga/jam')
                            ->numeric()
                            ->required(),
                        Select::make('status')
                            ->options([
                                'tersedia' => 'Tersedia',
                                'tidak tersedia' => 'Tidak tersedia',
                            ])->label('Status')->required(),

                    ]),
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
                ImageColumn::make('image'),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('listgame.name'),
                TextColumn::make('price')
                    ->label('Harga/jam'),
                SelectColumn::make('status')
                    ->options([
                        'tersedia' => 'Tersedia',
                        'tidak tersedia' => 'Tidak tersedia',
                    ])
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlaystations::route('/'),
            'create' => Pages\CreatePlaystation::route('/create'),
            'edit' => Pages\EditPlaystation::route('/{record}/edit'),
        ];
    }
}
