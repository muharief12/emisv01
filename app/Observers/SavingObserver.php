<?php

namespace App\Observers;

use App\Models\Finance;
use App\Models\User;

class SavingObserver
{
    // Define checker for observer feature activation
    protected function isSavingRelated(Finance $finance): bool
    {
        return in_array(
            $finance->type?->name,
            ['Tabungan', 'Pengambilan Tabungan'],
            true
        );
    }

    // business logic for recalculationSaving
    protected function recalculationSaving(int $userId)
    {
        $totalSaving = Finance::where('user_id', $userId)->whereHas('type', fn($q) => $q->where('name', "Tabungan"))->sum("total");
        $totalExpense = Finance::where('user_id', $userId)->whereHas('type', fn($q) => $q->where('name', "Pengambilan Tabungan"))->sum("total");

        User::whereKey($userId)->update([
            'saving' => $totalSaving - $totalExpense
        ]);
    }

    /**
     * Handle the User "created" event.
     */
    public function created(Finance $finance): void
    {
        if (! $this->isSavingRelated($finance)) {
            return;
        }
        $this->recalculationSaving($finance->user_id);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(Finance $finance): void
    {
        if (! $this->isSavingRelated($finance)) {
            return;
        }
        $this->recalculationSaving($finance->user_id);
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(Finance $finance): void
    {
        if (! $this->isSavingRelated($finance)) {
            return;
        }
        $this->recalculationSaving($finance->user_id);
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(Finance $finance): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(Finance $finance): void
    {
        //
    }
}
