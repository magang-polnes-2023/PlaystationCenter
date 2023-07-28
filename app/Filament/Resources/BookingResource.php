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

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

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
                        TextInput::make('booking_code')
                            ->label('Booking Code')
                            ->unique()
                            ->required(),
                        DatePicker::make('booking_date')
                            ->label('Tanggal Booking')
                            ->required(),
                        TextInput::make('booking_duration')
                            ->label('Durasi Booking (satuan jam')
                            ->required()
                            ->numeric(),
                        TimePicker::make('start_time')
                            ->label('Waktu Mulai')
                            ->required(),
                        TimePicker::make('end_time')
                            ->label('Waktu Selesai')
                            ->required(),
                        TextInput::make('total_pay')
                            ->label('Harga Total')
                            ->required(),
                        FileUpload::make('payment')
                            ->label('Bukti bayar'),
                        Select::make('status')
                            ->options([
                                'Belum dibayar' => 'Belum Dibayar',
                                'Sudah dibayar' => 'Sudah Dibayar',
                                'Digunakan' => 'Digunakan',
                                'Selesai' => 'Selesai',
                                'Cancel' => 'Cancel'
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
                TextColumn::make('booking_code')
                    ->label('Booking Code')
                    ->searchable(),
                TextColumn::make('booking_date')
                    ->Label('Tanggal Booking'),
                TextColumn::make('booking_duration')
                    ->Label('Durasi Booking'),
                TextColumn::make('start_time')
                    ->label('Jam mulai'),
                TextColumn::make('end_time')
                    ->label('Jam Selesai'),
                TextColumn::make('total_pay')
                    ->label('Total Harga'),
                ImageColumn::make('payment')
                    ->Label('Bukti Pembayaran'),
                SelectColumn::make('status')
                    ->options([
                        'Belum dibayar' => 'Belum Dibayar',
                        'Sudah dibayar' => 'Sudah Dibayar',
                        'Digunakan' => 'Digunakan',
                        'Selesai' => 'Selesai',
                        'Cancel' => 'Cancel'
                    ])
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
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
