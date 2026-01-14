<?php

namespace App\Filament\Resources\Finances\Pages;

use App\Filament\Resources\Finances\FinanceResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Auth;

class ViewFinance extends ViewRecord
{
    protected static string $resource = FinanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }

    protected function authorizeAccess(): void
    {
        parent::authorizeAccess();

        if (
            Auth::user()->role !== 'admin' &&
            $this->record->user_id !== Auth::id()
        ) {
            abort(403);
        }
    }
}
