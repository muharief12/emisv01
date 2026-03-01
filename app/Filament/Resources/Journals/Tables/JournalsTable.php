<?php

namespace App\Filament\Resources\Journals\Tables;

use Carbon\Carbon;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class JournalsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('teacher.name')
                    ->label('Guru')
                    ->sortable(),
                TextColumn::make('time')
                    ->label('Jadwal')
                    ->formatStateUsing(function ($state) {
                        Carbon::setLocale('id');
                        return Carbon::parse($state)->translatedFormat('l, d F Y');
                    })
                    ->sortable(),
                TextColumn::make('place')
                    ->label('Tempat')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->formatStateUsing(function ($record) {
                        Carbon::setLocale('id');
                        return Carbon::parse($record)->translatedFormat('l, d F Y, H:i:s');
                    })
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
