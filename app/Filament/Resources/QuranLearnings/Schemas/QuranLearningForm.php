<?php

namespace App\Filament\Resources\QuranLearnings\Schemas;

use App\Models\Journal;
use App\Models\Quran;
use App\Models\QuranVerse;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class QuranLearningForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
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
                        Select::make('student_id')
                            ->relationship('student', 'name')
                            ->required(),
                        Select::make('journals_id')
                            ->relationship('journal', 'time')
                            ->default(fn() => Journal::latest()->value('id'))
                            ->required(),
                    ])->columnSpanFull(),
                Section::make()
                    ->columns(3)
                    ->schema([
                        Select::make('quran_start_id')
                            ->required()
                            ->options(
                                Quran::pluck('transliteration', 'id')
                            )->searchable()
                            ->reactive()
                            ->afterStateUpdated(fn(Set $set) => $set('start_ayah', null)),
                        Select::make('start_ayah')
                            ->required()
                            ->reactive()
                            ->live()
                            ->searchable()
                            // ->options(function (Get $get) {
                            //     $surahId = $get('quran_start_id');

                            //     if (! $surahId) {
                            //         return [];
                            //     }

                            //     $numAyah = Quran::where('id', $surahId)->value('num_ayah');

                            //     if (! $numAyah) {
                            //         return [];
                            //     }

                            //     // Generate option: 1 => 1, 2 => 2, ..., n => n
                            //     return collect(range(1, $numAyah))
                            //         ->mapWithKeys(fn($i) => [$i => $i])
                            //         ->toArray();
                            // })
                            ->getSearchResultsUsing(function (string $search, Get $get) {
                                $surahId = $get('quran_start_id');

                                if (! $surahId) {
                                    return [];
                                }

                                $numAyah = Quran::where('id', $surahId)->value('num_ayah');

                                if (! $numAyah) {
                                    return [];
                                }

                                return collect(range(1, $numAyah))
                                    ->filter(fn($i) => str_contains((string) $i, $search))
                                    ->mapWithKeys(fn($i) => [$i => $i])
                                    ->toArray();
                            })
                            ->getOptionLabelUsing(fn($value) => (string) $value)
                            ->afterStateHydrated(function ($state, Get $get, Set $set) {
                                $surahId = $get('quran_start_id');

                                if (! $surahId) {
                                    return;
                                }

                                $numAyah = Quran::where('id', $surahId)->value('num_ayah');

                                if ($numAyah && $state > $numAyah) {
                                    $set('start_ayah', 1);
                                }
                            })
                            ->afterStateUpdated(function ($state, Get $get, Set $set) {
                                $surahId = $get('quran_start_id');

                                if (! $surahId || ! $state) {
                                    $set('start_page', null);
                                    return;
                                }

                                $page = QuranVerse::where('quran_id', $surahId)
                                    ->where('ayah', $state)
                                    ->value('page');

                                $set('start_page', $page);
                            }),
                        TextInput::make('start_page')
                            // ->label('Halaman Awal Setoran')
                            ->required()
                            ->numeric()
                            ->dehydrated()
                            ->disabled(),
                    ])->columnSpanFull(),
                Section::make()
                    ->columns(3)
                    ->schema([
                        Select::make('quran_end_id')
                            ->required()
                            ->options(
                                Quran::pluck('transliteration', 'id')
                            )->searchable()
                            ->reactive()
                            ->afterStateUpdated(fn(Set $set) => $set('end_ayah', null)),
                        Select::make('end_ayah')
                            ->required()
                            ->reactive()
                            ->searchable()
                            // ->options(function (Get $get) {
                            //     $surahId = $get('quran_end_id');

                            //     if (! $surahId) {
                            //         return [];
                            //     }

                            //     $numAyah = Quran::where('id', $surahId)->value('num_ayah');

                            //     if (! $numAyah) {
                            //         return [];
                            //     }

                            //     // Generate option: 1 => 1, 2 => 2, ..., n => n
                            //     return collect(range(1, $numAyah))
                            //         ->mapWithKeys(fn($i) => [$i => $i])
                            //         ->toArray();
                            // })
                            ->getSearchResultsUsing(function (string $search, Get $get) {
                                $surahId = $get('quran_end_id');

                                if (! $surahId) {
                                    return [];
                                }

                                $numAyah = Quran::where('id', $surahId)->value('num_ayah');

                                if (! $numAyah) {
                                    return [];
                                }

                                return collect(range(1, $numAyah))
                                    ->filter(fn($i) => str_contains((string) $i, $search))
                                    ->mapWithKeys(fn($i) => [$i => $i])
                                    ->toArray();
                            })
                            ->getOptionLabelUsing(fn($value) => (string) $value)
                            ->afterStateHydrated(function ($state, Get $get, Set $set) {
                                $surahId = $get('quran_end_id');

                                if (! $surahId) {
                                    return;
                                }

                                $numAyah = Quran::where('id', $surahId)->value('num_ayah');

                                if ($numAyah && $state > $numAyah) {
                                    $set('end_ayah', 1);
                                }
                            })
                            ->afterStateUpdated(function ($state, Get $get, Set $set) {
                                $surahId = $get('quran_end_id');

                                if (! $surahId || ! $state) {
                                    $set('end_page', null);
                                    return;
                                }

                                $page = QuranVerse::where('quran_id', $surahId)
                                    ->where('ayah', $state)
                                    ->value('page');

                                $set('end_page', $page);
                            }),
                        TextInput::make('end_page')
                            // ->label('Halaman Awal Setoran')
                            ->required()
                            ->dehydrated()
                            ->numeric()
                            ->disabled(),
                    ])->columnSpanFull(),
                Grid::make()
                    ->columns(2)
                    ->schema([
                        Textarea::make('note')
                            ->default("Sudah lancar tingkatkan muroja'ah dan bisa lanjut ke halaman berikutnya"),
                        Select::make('status')
                            ->options(['good' => 'Good', 'retake' => 'Retake'])
                            ->required(),
                    ])->columnSpanFull(),
                Placeholder::make('quran_pages_preview')
                    ->label('Preview Halaman Qur’an')
                    ->content(function (Get $get) {
                        $start = $get('start_page');
                        $end   = $get('end_page');

                        if (! $start || ! $end || $start > $end) {
                            $html = "<div style='text-align:center; background-color:#FFC7C2; border:1px; border-color:#F24822; color:#F24822; border-radius:10px; padding:10px 5px'>";
                            $html .= "Silakan pilih halaman awal dan akhir terlebih dahulu.</div>";
                        } else {
                            $html = "<div style='text-align:center; margin-bottom:12px;'>
                                    Preview halaman {$start} – {$end}
                                </div>";
                            $html .= "<div style='
                            display:grid;
                            grid-template-columns:repeat(auto-fit, minmax(300px, 1fr));
                            gap:24px;
                            justify-items:center;
                            direction:rtl;
                        '>";


                            for ($page = $start; $page <= $end; $page++) {
                                $pageFormatted = str_pad($page, 3, '0', STR_PAD_LEFT);

                                $html .= "
                                <div style='display:flex; justify-content:center;'>
                                    <img
                                        src='https://media.qurankemenag.net/khat2/QK_{$pageFormatted}.webp'
                                        style='
                                            width:100%;
                                            max-width:420px;
                                            border-radius:12px;
                                            background-color:white;
                                        '
                                        loading='lazy'
                                    />
                                </div>
                            ";
                            }

                            $html .= "</div>";
                        }

                        return new \Illuminate\Support\HtmlString($html);
                    })->columnSpanFull(),
            ]);
    }
}
