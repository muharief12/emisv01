<?php

namespace App\Filament\Student\Resources\QuranLearnings\Tables;

use Filament\Actions\BulkActionGroup;
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
                TextColumn::make('teacher_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('student_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('journals_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('quran_start_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('start_ayah')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('start_page')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('quran_end_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('end_ayah')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('end_page')
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
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
