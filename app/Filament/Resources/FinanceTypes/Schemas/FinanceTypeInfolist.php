<?php

namespace App\Filament\Resources\FinanceTypes\Schemas;

use App\Models\FinanceType;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class FinanceTypeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('type')
                    ->badge(),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (FinanceType $record): bool => $record->trashed()),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
