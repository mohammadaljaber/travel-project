<?php

namespace App\Observers;

use App\Models\Travel;

class Travelobservsr
{
    /**
     * Handle the Travel "created" event.
     */
    public function creating(Travel $travel): void
    {
        $travel->slug = str($travel->name)->slug();
    }
}
