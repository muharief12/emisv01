<?php

namespace App\Observers;

use App\Models\EventPayment;

class EventPaymentObserver
{
    protected function updateEventTotal(EventPayment $payment): void
    {
        if (! $payment->event) {
            return;
        }

        $total = $payment->event
            ->payments()
            ->sum('cost');

        $payment->event->update([
            'total_payment' => $total,
        ]);
    }

    /**
     * Handle the Payment "created" event.
     */
    public function created(EventPayment $payment): void
    {
        $this->updateEventTotal($payment);
    }

    /**
     * Handle the Payment "updated" event.
     */
    public function updated(EventPayment $payment): void
    {
        $this->updateEventTotal($payment);
    }

    /**
     * Handle the Payment "deleted" event.
     */
    public function deleted(EventPayment $payment): void
    {
        $this->updateEventTotal($payment);
    }

    /**
     * Handle the Payment "restored" event.
     */
    public function restored(EventPayment $payment): void
    {
        //
    }

    /**
     * Handle the Payment "force deleted" event.
     */
    public function forceDeleted(EventPayment $payment): void
    {
        //
    }
}
