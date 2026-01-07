<?php

namespace App\Filament\Resources\IqroLearnings\Pages;

use App\Filament\Resources\IqroLearnings\IqroLearningResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditIqroLearning extends EditRecord
{
    protected static string $resource = IqroLearningResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
