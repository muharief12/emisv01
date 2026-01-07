<?php

namespace App\Filament\Resources\IqroLearnings\Pages;

use App\Filament\Resources\IqroLearnings\IqroLearningResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListIqroLearnings extends ListRecords
{
    protected static string $resource = IqroLearningResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
