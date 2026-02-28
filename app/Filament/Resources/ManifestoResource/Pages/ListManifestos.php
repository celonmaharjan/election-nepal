<?php

namespace App\Filament\Resources\ManifestoResource\Pages;

use App\Filament\Resources\ManifestoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListManifestos extends ListRecords
{
    protected static string $resource = ManifestoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
