<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $table = 'events';
    protected $guarded = ['id'];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }

    public function payments()
    {
        return $this->hasMany(EventPayment::class, 'event_id', 'id');
    }

    public function getRouteKeyName(): string
    {
        return 'code';
    }
}
