<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
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
use PhpParser\Node\Stmt\Label;
use stdClass;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static function getNavigationLabel(): string
    {
        return "Booking";
    }

    public static function getPluralLabel(): string
    {
        return "Booking";
    }

    protected static ?string $navigationGroup = 'Order Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Select::make('playstation_id')
                            ->label('Nama Playstation')
                            ->relationship('playstation', 'name')
                            ->required(),
                        Select::make('user_id')
                            ->label('Nama User')
                            ->relationship('user', 'name')
                            ->required(),
                        DatePicker::make('booking_date')
                            ->label('Tanggal Booking')
                            ->required(),
                        TextInput::make('booking_duration')
                            ->label('Durasi Booking (satuan jam)')
                            ->required()
                            ->numeric(),
                        TimePicker::make('start_time')
                            ->label('Waktu Mulai')
                            ->required(),
                        TimePicker::make('end_time')
                            ->label('Waktu Selesai')
                            ->required(),
                        FileUpload::make('payment')
                            ->label('Bukti bayar'),
                        Select::make('status')
                            ->options([
                                'Belum dibayar' => 'Belum Dibayar',
                                'Sudah dibayar' => 'Sudah Dibayar',
                                'Digunakan' => 'Digunakan',
                                'Selesai' => 'Selesai'
                            ]),
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
                TextColumn::make('playstation.name')
                    ->searchable(),
                TextColumn::make('user.name')
                    ->searchable(),
                TextColumn::make('booking_date')
                    ->Label('Tanggal Booking'),
                TextColumn::make('booking_duration')
                    ->Label('Durasi Booking'),
                ImageColumn::make('payment')
                    ->Label('Bukti Pembayaran'),
                SelectColumn::make('status')
                    ->options([
                        'Belum dibayar' => 'Belum Dibayar',
                        'Sudah dibayar' => 'Sudah Dibayar',
                        'Digunakan' => 'Digunakan',
                        'Selesai' => 'Selesai'
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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
