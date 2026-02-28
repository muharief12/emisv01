<?php

namespace App\Filament\Resources\IqroLearnings\Schemas;

use Carbon\Carbon;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class IqroLearningInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextEntry::make('teacher.name')
                            ->label('Guru'),
                        TextEntry::make('student.name')
                            ->label('Santri/wati'),
                        TextEntry::make('journal.time')
                            ->formatStateUsing(function ($state) {
                                Carbon::setLocale('id');
                                return Carbon::parse($state)->translatedFormat('l, d F Y');
                            })
                            ->label('Jurnal Pembelajaran'),
                        TextEntry::make('level')
                            ->label('Level Iqro')
                            ->numeric(),
                        TextEntry::make('start_page')
                            ->label('Halaman Awal'),
                        TextEntry::make('end_page')
                            ->label('Halaman Akhir'),
                        TextEntry::make('note')
                            ->label('Catatan Penilaian')
                            ->placeholder('-')
                            ->columnSpanFull(),
                        TextEntry::make('status')
                            ->badge()
                            ->formatStateUsing(fn($state) => match ($state) {
                                'good' => 'Lancar',
                                'retake' => 'Mengulang'
                            })
                            ->color(fn($state) => match ($state) {
                                'good' => 'success',
                                'retake' => 'danger'
                            }),
                        TextEntry::make('created_at')
                            ->label('Dibuat pada')
                            ->formatStateUsing(function ($state) {
                                Carbon::setLocale('id');
                                return Carbon::parse($state)->translatedFormat('l, d F Y, H:i:s');
                            })
                            ->placeholder('-'),
                        TextEntry::make('updated_at')
                            ->label('Diperbarui pada')
                            ->formatStateUsing(function ($state) {
                                Carbon::setLocale('id');
                                return Carbon::parse($state)->translatedFormat('l, d F Y, H:i:s');
                            })
                            ->placeholder('-'),
                    ])->columns(3)
            ])->columns(1);
    }
}
