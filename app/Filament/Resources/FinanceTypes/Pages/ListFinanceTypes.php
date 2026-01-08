<?php

namespace App\Filament\Resources\FinanceTypes\Pages;

use App\Filament\Resources\FinanceTypes\FinanceTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFinanceTypes extends ListRecords
{
    protected static string $resource = FinanceTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
