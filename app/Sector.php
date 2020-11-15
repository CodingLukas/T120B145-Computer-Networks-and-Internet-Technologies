<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    public function getFreeCount($eventId)
    {
        $total = $this->size;

        $usedSeats = Reservation::query()->where([
            'sector_id' => $this->id,
            'event_id' => $eventId
        ])->count();

        return $total - $usedSeats;
    }

    public function getPricePerSeat()
    {
        return $this->price_per_seat;
    }

    public function getId()
    {
        return $this->id;
    }
}
