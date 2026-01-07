<?php

namespace App\Filament\Resources\Journals\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Metadata\Group;

use function Symfony\Component\Clock\now;

class JournalForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make()
                    ->columns(3)
                    ->schema([
                        Select::make('teacher_id')
                            ->required()
                            ->options([
                                Auth::id() => Auth::user()->name,
                            ])
                            ->default(Auth::id())
                            ->preload()
                            ->searchable(),
                        DatePicker::make('time')
                            ->default(fn() => today())
                            ->native(false)
                            ->required(),
                        TextInput::make('place')
                            ->required()
                            ->default('Masjid Al Jannah'),
                    ])->columnSpanFull(),
                Textarea::make('agenda')
                    ->required()
                    ->default('Tilawah harian')
                    ->columnSpanFull(),
            ]);
    }
}
