<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventPayment extends Model
{
    protected $table = 'event_payments';
    protected $guarded = ['id'];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    // protected static function booted()
    // {
    //     static::creating(function ($payment) {
    //         if ($payment->event && is_null($payment->cost)) {
    //             $payment->cost = $payment->event->cost;
    //         }
    //     });
    // }
}
