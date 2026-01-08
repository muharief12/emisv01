<?php

namespace App\Filament\Resources\FinanceTypes\Pages;

use App\Filament\Resources\FinanceTypes\FinanceTypeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewFinanceType extends ViewRecord
{
    protected static string $resource = FinanceTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
