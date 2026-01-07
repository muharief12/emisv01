<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuranVerse extends Model
{
    protected $table = 'quran_verses';
    protected $guarded = ['id'];

    public function surah(): BelongsTo
    {
        return $this->belongsTo(Quran::class, 'quran_id', 'id');
    }
}
