<?php

namespace App\Filament\Resources\FinanceTypes;

use App\Filament\Resources\FinanceTypes\Pages\CreateFinanceType;
use App\Filament\Resources\FinanceTypes\Pages\EditFinanceType;
use App\Filament\Resources\FinanceTypes\Pages\ListFinanceTypes;
use App\Filament\Resources\FinanceTypes\Pages\ViewFinanceType;
use App\Filament\Resources\FinanceTypes\Schemas\FinanceTypeForm;
use App\Filament\Resources\FinanceTypes\Schemas\FinanceTypeInfolist;
use App\Filament\Resources\FinanceTypes\Tables\FinanceTypesTable;
use App\Models\FinanceType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class FinanceTypeResource extends Resource
{
    protected static ?string $model = FinanceType::class;
    protected static string | UnitEnum | null $navigationGroup = 'Keuangan';
    protected static ?string $navigationLabel = 'Jenis Keuangan';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBanknotes;

    public static function form(Schema $schema): Schema
    {
        return FinanceTypeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return FinanceTypeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FinanceTypesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFinanceTypes::route('/'),
            'create' => CreateFinanceType::route('/create'),
            'view' => ViewFinanceType::route('/{record}'),
            'edit' => EditFinanceType::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
