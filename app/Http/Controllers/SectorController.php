<?php

namespace App\Http\Controllers;

use App\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sectors = Sector::latest()->paginate(5);

        return view('sectors.index', compact('sectors'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

}
