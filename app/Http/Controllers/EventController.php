<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->isEditor()) {
            $events = Event::query()->where(['user_id' => Auth::user()->getId()])->paginate(5);
        } else {
            $events = Event::latest()->paginate(5);
        }

        return view('events.index', compact('events'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'name' => 'required',
            //'start_date' => 'required',
            // 'end_date' => 'required'
        ];

        $data = $request->validate($data);

        $data['user_id'] = Auth::user()->getId();

        Event::create($data);

        return redirect()->route('events.index')
            ->with('success', 'Renginys sukurtas sėkmingai.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        $active = $request->input('active') ? true : false;

        $events = Event::query()->where('active', 1)->get();

        if ($active && $events->isNotEmpty()) {
            return back()->withErrors('Renginys jau aktyvus!')->withInput();
        } else {
            if ($validator->fails()) {
                return redirect()->route('events.edit', $event->getId())
                    ->withErrors($validator)->withInput();
            }
        }

        $data = [
            'name' => $request->get('name'),
            'active' => $active
        ];

        $event->update($data);

        return redirect()->route('events.index')
            ->with('success', 'Event updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Event deleted successfully');
    }
}
