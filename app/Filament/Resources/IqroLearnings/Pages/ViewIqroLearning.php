<?php

namespace App\Filament\Resources\IqroLearnings\Pages;

use App\Filament\Resources\IqroLearnings\IqroLearningResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewIqroLearning extends ViewRecord
{
    protected static string $resource = IqroLearningResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
