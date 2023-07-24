<?php

namespace App\Filament\Resources\PlaystationResource\Pages;

use App\Filament\Resources\PlaystationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPlaystation extends EditRecord
{
    protected static string $resource = PlaystationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
