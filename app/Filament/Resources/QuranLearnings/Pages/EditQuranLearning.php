<?php

namespace App\Filament\Resources\QuranLearnings\Pages;

use App\Filament\Resources\QuranLearnings\QuranLearningResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditQuranLearning extends EditRecord
{
    protected static string $resource = QuranLearningResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
