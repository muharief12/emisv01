<?php

namespace App\Filament\Resources\IqroLearnings\Schemas;

use App\Models\IqroLearning;
use App\Models\Journal;
use Carbon\Carbon;
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

class IqroLearningForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columns(3)
                    ->schema([
                        Select::make('teacher_id')
                            ->label('Guru')
                            ->required()
                            ->options([
                                Auth::id() => Auth::user()->name,
                            ])
                            ->default(Auth::id())
                            ->preload()
                            ->searchable(),
                        Select::make('student_id')
                            ->searchable()
                            ->live()
                            ->preload()
                            ->label('Satri/wati')
                            ->relationship('student', 'name')
                            ->required(),
                        Select::make('journals_id')
                            ->label('Jurnal Pembelajaran')
                            ->relationship('journal', 'time')
                            ->getOptionLabelFromRecordUsing(
                                function ($record) {
                                    Carbon::setLocale('id');
                                    return Carbon::parse($record->time)->translatedFormat('l, d F Y');
                                }
                            )
                            ->default(fn() => Journal::latest()->first()?->id)
                            ->required(),
                    ])->columnSpanFull(),
                Section::make()
                    ->columns(3)
                    ->schema([
                        Select::make('level')
                            ->required()
                            ->reactive()
                            ->options(
                                [
                                    1 => '1',
                                    2 => '2',
                                    3 => '3',
                                    4 => '4',
                                    5 => '5',
                                    6 => '6',
                                ]
                            )->searchable(),
                        Select::make('start_page')
                            ->label('Halaman Awal Penilaian')
                            ->live()
                            ->required()
                            ->reactive()
                            ->options(
                                function () {
                                    $options = [];

                                    for ($i = 1; $i <= 32; $i++) {
                                        $options[$i] = $i;
                                    }
                                    return $options;
                                }
                            )->searchable(),
                        Select::make('end_page')
                            ->label('Halaman Akhir Penilaian')
                            ->live()
                            ->required()
                            ->reactive()
                            ->options(
                                function () {
                                    $options = [];

                                    for ($i = 1; $i <= 32; $i++) {
                                        $options[$i] = $i;
                                    }
                                    return $options;
                                }
                            )->searchable(),
                    ])->columnSpanFull(),
                Grid::make()
                    ->columns(2)
                    ->schema([
                        Select::make('status')
                            ->options(['good' => 'Lancar', 'retake' => 'Mengulang'])
                            ->live()
                            ->afterStateUpdated(function ($state, Set $set) {
                                if ($state === "good") {
                                    $set('note', "Alhamdulillah, sudah lancar.. tingkatkan muroja'ah dan pertemuan berikutnya bisa lanjut ke halaman berikutnya");
                                } elseif ($state === "retake") {
                                    $set('note', "Tetap semangat walaupun masih belum lancar, tingkatkan muroja'ah dan perlu mengulang pada pertemuan berikutnya ya");
                                } else {
                                    $set('note', "-");
                                }
                            })
                            ->required(),
                        Textarea::make('note')
                            ->label('Catatan Penilaian')
                            ->default("-"),
                    ])->columnSpanFull(),
                Placeholder::make('quran_pages_preview')
                    ->label("Preview Halaman Iqro'")
                    ->content(function (Get $get) {
                        $level = $get('level');
                        $start = $get('start_page');
                        $end   = $get('end_page');

                        if (! $level || ! $start || ! $end || $start > $end) {
                            $html = "<div style='text-align:center; background-color:#FFC7C2; border:1px; border-color:#F24822; color:#F24822; border-radius:10px; padding:10px 5px'>";
                            $html .= "Silakan pilih halaman awal dan akhir terlebih dahulu.</div>";
                        } elseif (!IqroLearning::where('level', $level)->where('start_page', $start)->where('end_page', $end)->first()) {
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
                                // $pageFormatted = str_pad($page, 3, '0', STR_PAD_LEFT);
                                $src = "https://tbdexxmufltckrhznlmg.supabase.co/storage/v1/object/public/iqro_preview/{$level}/IQ-{$level}.{$page}.jpg";
                                $html .= "
                                <div style='display:flex; justify-content:center;'>
                                    <img
                                        
                                        src='{$src}'
                                        style='
                                            width:100%;
                                            max-width:420px;
                                            border-radius:12px;
                                            background-color:white;
                                        '
                                        alt=''
                                        loading='lazy'
                                    />
                                </div>
                            ";
                            }

                            $html .= "</div>";
                        } else {
                            $html = "<div style='text-align:center; background-color:#FFC7C2; border:1px; border-color:#F24822; color:#F24822; border-radius:10px; padding:10px 5px'>";
                            $html .= "Maaf untuk Level dan Halaman Iqro' yang dipilih belum tersedia.</div>";
                        }

                        return new \Illuminate\Support\HtmlString($html);
                    })->columnSpanFull(),
            ]);
    }
}
