<?php

namespace App\Filament\Resources\QuranLearnings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class QuranLearningsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('teacher.name')
                    ->label('Pemeriksa')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('student.name')
                    ->label('Santri/wati')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('journal.time')
                    ->label('Waktu Pelaksanaan')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('quranStart.transliteration')
                    ->label('Mulai QS.')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('start_ayah')
                    ->label('Ayat ke')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('start_page')
                    ->label('Halaman')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('quran_end_id')
                    ->label('Sampai QS.')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('end_ayah')
                    ->label('Sampai Ayat')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('end_page')
                    ->label('Halaman')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('created_at')
                    ->dateTime()
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
                ViewAction::make(),
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
