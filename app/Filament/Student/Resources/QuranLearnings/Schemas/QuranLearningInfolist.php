<?php

namespace App\Filament\Student\Resources\QuranLearnings\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class QuranLearningInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('teacher_id')
                    ->numeric(),
                TextEntry::make('student_id')
                    ->numeric(),
                TextEntry::make('journals_id')
                    ->numeric(),
                TextEntry::make('quran_start_id')
                    ->numeric(),
                TextEntry::make('start_ayah')
                    ->numeric(),
                TextEntry::make('start_page')
                    ->numeric(),
                TextEntry::make('quran_end_id')
                    ->numeric(),
                TextEntry::make('end_ayah')
                    ->numeric(),
                TextEntry::make('end_page')
                    ->numeric(),
                TextEntry::make('note')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('status')
                    ->badge(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
