<?php

namespace App\Filament\Student\Resources\QuranLearnings\Pages;

use App\Filament\Student\Resources\QuranLearnings\QuranLearningResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditQuranLearning extends EditRecord
{
    protected static string $resource = QuranLearningResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
