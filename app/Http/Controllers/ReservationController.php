<?php

namespace App\Http\Controllers;

use App\Event;
use App\Sector;
use App\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $eventId)
    {
        $sectors = Sector::all();
        foreach ($sectors as $sector) {
            $amount = $request->get('sector-'.($sector->id - 1));
                $totalFree = $sector->getFreeCount($eventId);
                if ($totalFree >= $amount) {
                    for ($j = 0; $j < $amount; $j++) {
                         $data = [
                            'user_id' => Auth::user()->getId(),
                            'event_id' => $eventId,
                            'sector_id' => $sector->getId()
                        ];
                        Reservation::create($data);
                    }
                } else {
                    return back()->withErrors('Renginys neturi tiek laisvų vietų!')->withInput();
                }
        }

        return redirect()->route('home')
            ->with('success', 'Sėkmingai pavyko rezervuoti bilietus');
    }
}
