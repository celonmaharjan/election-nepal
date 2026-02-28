<?php

namespace App\Filament\Resources\ManifestoResource\Pages;

use App\Filament\Resources\ManifestoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditManifesto extends EditRecord
{
    protected static string $resource = ManifestoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
