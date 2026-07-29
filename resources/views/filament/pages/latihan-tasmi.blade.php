<x-filament-panels::page>
    {{-- Import Google Fonts (Amiri) khusus aksara Arab --}}
    @push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    @endpush

    <div class="space-y-6">
        {{ $this->form }}

    </div>


    @if (!empty($soalTasmi))
    <div class="mt-6 mb-6 space-y-4">
        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">
            Daftar Soal Tasmi' (5 Ayat Acak)
        </h3>

        <div class="space-y-6">
            @foreach ($soalTasmi as $item)
            @php
            $soal = $item['soal'];
            $kunci = $item['kunci_jawaban'];
            @endphp

            <x-filament::section
                collapsible
                collapsed
                icon="heroicon-o-question-mark-circle">
                <x-slot name="heading">
                    <div class="flex items-center justify-between w-full mb-[5px] pr-4">
                        <span class="font-semibold text-primary-600">Soal #{{ $item['nomor_soal'] }}</span>
                        <span class="text-xs text-gray-500">
                            Ayat {{ $soal->ayah }} | Halaman {{ $soal->page }}
                        </span>
                    </div>
                </x-slot>

                <x-slot name="description">
                    {{-- Tampilan Teks Arab Soal Utama --}}
                    <div
                        class="mt-3 text-right text-3xl leading-[2.6] text-gray-900 dark:text-gray-100 font-bold"
                        dir="rtl"
                        style="font-family: 'Amiri', serif; font-size:x-large;">
                        {{ $soal->arabic }}
                    </div>
                </x-slot>

                {{-- Isi Section: Kunci Jawaban (5 Ayat Selanjutnya) --}}
                <div class="pt-4 border-t border-gray-200 dark:border-gray-700 space-y-3">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-gray-400">
                        Lanjutan 5 Ayat Berikutnya (Kunci Jawaban):
                    </h4>

                    <div class="space-y-4" dir="rtl">
                        @foreach ($kunci as $nextVerse)
                        <div class="p-3 rounded-lg bg-gray-50 dark:bg-gray-800/50 text-right">
                            <div class="text-xs text-gray-400 my-[2px]" dir="rtl">
                                Ayat {{ $nextVerse->ayah }} (Hal. {{ $nextVerse->page }})
                            </div>
                            <div
                                class="text-4xl text-gray-800 dark:text-gray-200 leading-[2.3]"
                                style="font-family: 'Amiri', serif; font-size:x-large;">
                                {{ $nextVerse->arabic }}
                            </div>
                        </div>
                        <hr>
                        @endforeach
                    </div>
                </div>
            </x-filament::section>
            @endforeach
        </div>
    </div>
    @endif
</x-filament-panels::page>