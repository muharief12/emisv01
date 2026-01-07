<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quran extends Model
{
    protected $table = 'qurans';
    protected $guarded = ['id'];

    public function verses(): HasMany
    {
        return $this->hasMany(QuranVerse::class, 'quran_id');
    }
}
