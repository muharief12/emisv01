<?php

namespace App\Filament\Resources\IqroLearnings\Schemas;

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
                            ->required(),
                    ])->columnSpanFull(),
                Section::make()
                    ->columns(3)
                    ->schema([
                        Select::make('level')
                            ->required()
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
                        TextInput::make('start_page')
                            // ->label('Halaman Awal Setoran')
                            ->required()
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
                // Placeholder::make('quran_pages_preview')
                //     ->label('Preview Halaman Qur’an')
                //     ->content(function (Get $get) {
                //         $level = $get('level');
                //         $start = $get('start_page');
                //         $end   = $get('end_page');

                //         if (! $start || ! $end || $start > $end) {
                //             $html = "<div style='text-align:center; background-color:#FFC7C2; border:1px; border-color:#F24822; color:#F24822; border-radius:10px; padding:10px 5px'>";
                //             $html .= "Silakan pilih halaman awal dan akhir terlebih dahulu.</div>";
                //         } else {
                //             $html = "<div style='text-align:center; margin-bottom:12px;'>
                //                     Preview halaman {$start} – {$end}
                //                 </div>";
                //             $html .= "<div style='
                //             display:grid;
                //             grid-template-columns:repeat(auto-fit, minmax(300px, 1fr));
                //             gap:24px;
                //             justify-items:center;
                //             direction:rtl;
                //         '>";


                //             for ($page = $start; $page <= $end; $page++) {
                //                 $pageFormatted = str_pad($page, 3, '0', STR_PAD_LEFT);

                //                 $html .= "
                //                 <div style='display:flex; justify-content:center;'>
                //                     <img
                //                         src='https://media.qurankemenag.net/khat2/QK_{$pageFormatted}.webp'
                //                         src='https://tpqonline.com/jilid-{$level}/4-5.png'
                //                         style='
                //                             width:100%;
                //                             max-width:420px;
                //                             border-radius:12px;
                //                             background-color:white;
                //                         '
                //                         loading='lazy'
                //                     />
                //                 </div>
                //             ";
                //             }

                //             $html .= "</div>";
                //         }

                //         return new \Illuminate\Support\HtmlString($html);
                //     })->columnSpanFull(),
            ]);
    }
}
