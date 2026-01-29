<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    protected $table = 'journals';
    protected $guarded = ['id'];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }

    public function iqros()
    {
        return $this->hasMany(IqroLearning::class, 'journals_id');
    }

    public function qurans()
    {
        return $this->hasMany(QuranLearning::class, 'journals_id');
    }
}
