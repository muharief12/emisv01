<?php

namespace App\Filament\Resources\IqroLearnings;

use App\Filament\Resources\IqroLearnings\Pages\CreateIqroLearning;
use App\Filament\Resources\IqroLearnings\Pages\EditIqroLearning;
use App\Filament\Resources\IqroLearnings\Pages\ListIqroLearnings;
use App\Filament\Resources\IqroLearnings\Pages\ViewIqroLearning;
use App\Filament\Resources\IqroLearnings\Schemas\IqroLearningForm;
use App\Filament\Resources\IqroLearnings\Schemas\IqroLearningInfolist;
use App\Filament\Resources\IqroLearnings\Tables\IqroLearningsTable;
use App\Models\IqroLearning;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class IqroLearningResource extends Resource
{
    protected static ?string $model = IqroLearning::class;
    protected static string | UnitEnum | null $navigationGroup = 'Pembelajaran';
    protected static ?string $navigationLabel = 'Pembelajaran Iqro';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return IqroLearningForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return IqroLearningInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return IqroLearningsTable::configure($table);
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
            'index' => ListIqroLearnings::route('/'),
            'create' => CreateIqroLearning::route('/create'),
            'view' => ViewIqroLearning::route('/{record}'),
            'edit' => EditIqroLearning::route('/{record}/edit'),
        ];
    }
}
