<?php

namespace App\Filament\Resources\ElectionTimelineResource\Pages;

use App\Filament\Resources\ElectionTimelineResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListElectionTimelines extends ListRecords
{
    protected static string $resource = ElectionTimelineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
