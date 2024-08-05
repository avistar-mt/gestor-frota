<?php

namespace App\Jobs;

use App\Enums\ReservationType;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Reservation;

class CheckReservationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $now = Carbon::now();

        Reservation::where('checkin_completed', false)
            ->where('reservation_star', '<=', $now->addMinutes(30))
            ->update(['status' => ReservationType::NEGADO]);

    }
}
