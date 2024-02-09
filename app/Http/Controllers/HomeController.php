<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $order=Order::all();
        return view('Writers.index', compact('order'));
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
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;

            if ($usertype != 'admin') {
                return view('Writers.order');
            } else {
                return view('Writers.order');
            }
        } else {
            return view('auth.login');
        }

    }

    public function new_order()
    {
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;

            if ($usertype != 'admin') {
                return view('Writers.new_order');
            } else {
                return view('Writers.New_order');
            }
        } else {
            return view('auth.login');
        }

    }

    public function new_files()
    {
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;

            if ($usertype != 'admin') {
                return view('Writers.new_files');
            } else {
                return view('Admin.file_upload');
            }
        } else {
            return view('auth.login');
        }

    }
}
