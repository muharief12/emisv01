<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IqroLearning extends Model
{
    protected $table = 'iqro_learnings';
    protected $guarded = ['id'];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }

    public function journal()
    {
        return $this->belongsTo(Journal::class, 'journals_id', 'id');
    }

    public function quran()
    {
        return $this->belongsTo(Quran::class, 'quran_start_id', 'id');
    }
}
