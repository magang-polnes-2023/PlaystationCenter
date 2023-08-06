<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Models\Booking;
use App\Models\Playstation;
use Closure;
use DateTime;
use Faker\Provider\ar_EG\Text;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
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
use Illuminate\Support\Str;
use Filament\Forms\Get;
use Illuminate\Database\Eloquent\Factories\Relationship;
use Illuminate\Database\Eloquent\Model;

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
        $prefix = 'ORD-PS-';
        $latestBooking = Booking::orderByDesc('id')->first();
        $increment = $latestBooking ? intval(substr($latestBooking->booking_code, -3)) + 1 : 1;
        $bookingCode = $prefix . str_pad($increment, 3, '0', STR_PAD_LEFT);

        return $form
            ->schema([
                Section::make('Information User and Playstation')
                    ->schema([
                        Select::make('user_id')
                            ->label('Nama User')
                            ->relationship('user', 'name')
                            ->required(),
                        Select::make('playstation_id')
                            ->label('Nama Playstation')
                            ->relationship('playstation', 'name')
                            ->reactive()
                            ->afterStateUpdated(function (Closure $set, $state) {

                                $selected = Playstation::find($state);

                                $price = $selected ? $selected->price : null;

                                $set('price', $price);
                            })
                            ->required(),
                        Fieldset::make('Playstation Price')
                            ->schema([
                                TextInput::make('price')
                                    ->label('Price')
                                    ->disabled(),
                            ]),
                        TextInput::make('booking_code')
                            ->label('Booking Code')
                            ->unique(ignorable: fn ($record) => $record)
                            ->default($bookingCode)
                            ->required(),
                    ]),
                Section::make('Booking Information')
                    ->schema([
                        DatePicker::make('booking_date')
                            ->label('Tanggal Booking')
                            ->required(),
                        TextInput::make('booking_duration')
                            ->label('Durasi Booking (satuan jam')
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function (Closure $set, $state, $get) {

                                $price = $get('price');

                                $totalPay = $price * $state;

                                $set('total_pay', $totalPay);
                            })
                            ->numeric(),
                        TimePicker::make('start_time')
                            ->label('Waktu Mulai')
                            ->reactive()
                            ->afterStateUpdated(function (Closure $set, $state, $get) {
                                $startTime = DateTime::createFromFormat('Y-m-d H:i:s', $state);

                                $duration = (int) $get('booking_duration');

                                $endTime = clone $startTime;
                                $endTime->modify("+" . $duration . " hours");

                                $endTimeStr = $endTime->format('Y-m-d H:i:s');

                                $set('end_time', $endTimeStr);
                            })
                            ->required(),
                        TimePicker::make('end_time')
                            ->label('Waktu Selesai')
                            ->required(),
                        TextInput::make('total_pay')
                            ->label('Harga Total')
                            ->required(),
                    ]),
                Section::make('Payment and Status')
                    ->schema([
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
                    ]),
                TextColumn::make('updated_at')
                    ->label('Updated_at')
                    ->sortable(),
            ])->defaultSort('updated_at')
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
            ->orderByRaw("CASE WHEN status = 'Belum Dibayar' THEN 1 
                WHEN status = 'Sudah Dibayar' THEN 2 
                WHEN status = 'Digunakan' THEN 3 
                WHEN status = 'Selesai' THEN 4
                ELSE 5 END")
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getRelations(): array
    {
        return [];
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
