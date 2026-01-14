<?php

namespace App\Filament\Resources\Finances\Pages;

use App\Filament\Resources\Finances\FinanceResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditFinance extends EditRecord
{
    protected static string $resource = FinanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
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
