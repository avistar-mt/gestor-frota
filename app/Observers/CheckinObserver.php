<?php

namespace App\Observers;

use App\Models\Checkin;
use App\Enums\StatusType;

class CheckinObserver
{
    /**
     * Handle the Checkin "created" event.
     */
    public function created(Checkin $checkin): void
    {
        //
    }

    /**
     * Handle the Checkin "updated" event.
     */
    public function updated(Checkin $checkin): void
    {
             $checkin->where('status', StatusType::PENDENTE)->update(['user_id' => null]);
    }

    /**
     * Handle the Checkin "deleted" event.
     */
    public function deleted(Checkin $checkin): void
    {
        //
    }

    /**
     * Handle the Checkin "restored" event.
     */
    public function restored(Checkin $checkin): void
    {
        //
    }

    /**
     * Handle the Checkin "force deleted" event.
     */
    public function forceDeleted(Checkin $checkin): void
    {
        //
    }
}
