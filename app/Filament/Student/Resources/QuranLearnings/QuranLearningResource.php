<?php

namespace App\Filament\Student\Resources\QuranLearnings;

use App\Filament\Student\Resources\QuranLearnings\Pages\CreateQuranLearning;
use App\Filament\Student\Resources\QuranLearnings\Pages\EditQuranLearning;
use App\Filament\Student\Resources\QuranLearnings\Pages\ListQuranLearnings;
use App\Filament\Student\Resources\QuranLearnings\Pages\ViewQuranLearning;
use App\Filament\Student\Resources\QuranLearnings\Schemas\QuranLearningForm;
use App\Filament\Student\Resources\QuranLearnings\Schemas\QuranLearningInfolist;
use App\Filament\Student\Resources\QuranLearnings\Tables\QuranLearningsTable;
use App\Models\QuranLearning;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class QuranLearningResource extends Resource
{
    protected static ?string $model = QuranLearning::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return QuranLearningForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return QuranLearningInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuranLearningsTable::configure($table);
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
            'index' => ListQuranLearnings::route('/'),
            'create' => CreateQuranLearning::route('/create'),
            'view' => ViewQuranLearning::route('/{record}'),
            'edit' => EditQuranLearning::route('/{record}/edit'),
        ];
    }
}
