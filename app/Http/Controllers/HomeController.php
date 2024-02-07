<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('Writers.index');
    }
    public function Bids()
    {
        return view('Writers.Bids');

    }
    public function Finished()
    {
        return view('Writers.Finished');

    }

    public function revision()
    {
        return view('Writers.Revision');
    }

    public function current()
    {
        return view('Writers.current');
    }

    public function Dispute()
    {
        return view('Writers.Dispute');
    }

    public function order()
    {
        return view('Writers.order');
    }
}
