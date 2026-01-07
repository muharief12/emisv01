<?php

namespace App\Filament\Resources\QuranLearnings;

use App\Filament\Resources\QuranLearnings\Pages\CreateQuranLearning;
use App\Filament\Resources\QuranLearnings\Pages\EditQuranLearning;
use App\Filament\Resources\QuranLearnings\Pages\ListQuranLearnings;
use App\Filament\Resources\QuranLearnings\Schemas\QuranLearningForm;
use App\Filament\Resources\QuranLearnings\Tables\QuranLearningsTable;
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
            'edit' => EditQuranLearning::route('/{record}/edit'),
        ];
    }
}
