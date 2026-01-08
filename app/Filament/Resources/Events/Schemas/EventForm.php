<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make()
                    ->columns(3)
                    ->schema([
                        TextInput::make('code')
                            ->default(fn() => Str::random(10))
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->disabled()
                            ->dehydrated(),
                        Select::make('teacher_id')
                            ->required()
                            ->options([
                                Auth::id() => Auth::user()->name,
                            ])
                            ->default(Auth::id())
                            ->preload()
                            ->searchable(),
                        TextInput::make('name')
                            ->required(),
                    ])->columnSpanFull(),
                Grid::make()
                    ->columns(2)
                    ->schema([
                        DateTimePicker::make('schedule')
                            ->required()
                            ->default(fn() => now()->addDays(7)->setTime(8, 0)),
                        TextInput::make('cost')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->prefix('$'),
                    ])->columnSpanFull(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
