<?php

namespace App\Filament\Resources\IqroLearnings\Tables;

use App\Models\IqroLearning;
use Carbon\Carbon;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class IqroLearningsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                if (Auth::user()->hasRole('Santri/wati')) {
                    $query->where('student_id', Auth::id());
                }
            })
            ->columns([
                TextColumn::make('teacher.name')
                    ->label('Guru')
                    ->sortable(),
                TextColumn::make('student.name')
                    ->label('Santri/wati')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('journal.time')
                    ->label('Jurnal Pembelajaran')
                    ->formatStateUsing(function ($state) {
                        Carbon::setLocale('id');
                        return Carbon::parse($state)->translatedFormat('l, d F Y');
                    })
                    ->sortable(),
                TextColumn::make('level')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('start_page')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('end_page')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn($state) => match ($state) {
                        'good' => 'Lancar',
                        'retake' => 'Mengulang'
                    })
                    ->color(fn($state) => match ($state) {
                        'good' => 'success',
                        'retake' => 'danger'
                    }),
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
