<?php

namespace App\Http\Controllers;

use App\Event;
use App\Sector;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $event = Event::query()->where(['active' => 1 ])->first();
        $sectors = Sector::all();

        return view('index', compact('sectors','event'));
    }
}
