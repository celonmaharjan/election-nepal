<?php

namespace App\Filament\Resources\ElectionTimelineResource\Pages;

use App\Filament\Resources\ElectionTimelineResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditElectionTimeline extends EditRecord
{
    protected static string $resource = ElectionTimelineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
