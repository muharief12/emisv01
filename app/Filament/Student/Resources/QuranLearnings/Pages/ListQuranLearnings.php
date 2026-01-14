<?php

namespace App\Filament\Student\Resources\QuranLearnings\Pages;

use App\Filament\Student\Resources\QuranLearnings\QuranLearningResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListQuranLearnings extends ListRecords
{
    protected static string $resource = QuranLearningResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
