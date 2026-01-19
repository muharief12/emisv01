<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn($state) => filled($state) ? bcrypt($state) : null)
                    ->dehydrated(fn($state) => filled($state))
                    ->required(fn(string $context) => $context === 'create'),
                TextInput::make('role')
                    ->required()
                    ->default('student'),
                TextInput::make('saving')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('parent_name'),
                TextInput::make('phone_number')
                    ->placeholder('628XXX'),
                Select::make('level')
                    ->options(['iqro' => 'Iqro', 'quran' => 'Quran', 'juz_amma' => 'Juz amma'])
                    ->default(null),
            ]);
    }
}
