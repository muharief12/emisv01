<?php

namespace App\Filament\Resources\Finances\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class FinanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->default(Auth::user()->id)
                    ->searchable()
                    ->preload()
                    ->live(),
                Select::make('type_id')
                    ->relationship('type', 'name')
                    ->searchable()
                    ->preload()
                    ->live()
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('total')
                    ->required()
                    ->numeric(),
            ]);
    }
}
