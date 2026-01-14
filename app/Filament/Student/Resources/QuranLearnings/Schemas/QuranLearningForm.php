<?php

namespace App\Filament\Student\Resources\QuranLearnings\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class QuranLearningForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('teacher_id')
                    ->required()
                    ->numeric(),
                TextInput::make('student_id')
                    ->required()
                    ->numeric(),
                TextInput::make('journals_id')
                    ->required()
                    ->numeric(),
                TextInput::make('quran_start_id')
                    ->required()
                    ->numeric(),
                TextInput::make('start_ayah')
                    ->required()
                    ->numeric(),
                TextInput::make('start_page')
                    ->required()
                    ->numeric(),
                TextInput::make('quran_end_id')
                    ->required()
                    ->numeric(),
                TextInput::make('end_ayah')
                    ->required()
                    ->numeric(),
                TextInput::make('end_page')
                    ->required()
                    ->numeric(),
                Textarea::make('note')
                    ->default(null)
                    ->columnSpanFull(),
                Select::make('status')
                    ->options(['good' => 'Good', 'retake' => 'Retake'])
                    ->required(),
            ]);
    }
}
