<?php

namespace App\Filament\Student\Resources\QuranLearnings\Pages;

use App\Filament\Student\Resources\QuranLearnings\QuranLearningResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewQuranLearning extends ViewRecord
{
    protected static string $resource = QuranLearningResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
