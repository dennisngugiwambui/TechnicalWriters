<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\MyOrder;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

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
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;

            if ($usertype != 'admin') {
                $order=Order::all();
                $available= Order::count();
                $bidCount=Bid::count();
                return view('Writers.index', compact('order', 'available', 'bidCount'));
            } else {
                $order=Order::all();
                $available= Order::count();
                return view('Admin.available', compact('available', 'order'));
            }
        } else {
            return view('auth.login');
        }
    }
    public function Bids(Request $request)
    {

        if (Auth::id()) {
            $usertype = Auth::user()->usertype;

            if ($usertype === 'writer') {
                $available=Order::count();
                $bidCount=Bid::count();
                $bidder=auth()->user();
                if (!$bidder || $bidder->usertype !== 'writer') {

                    Alert::success('success', 'this order is only visible to owner writer');
                    return redirect()->route('home')->with('error', 'You are not authorized to view bids.');
                }
                $bids=Bid::where('writer_id', $bidder->id)->get();
                return view('Writers.Bids', compact('bidCount', 'bids', 'available'));
            } else if ($usertype === 'admin') {
                $order = Order::findOrFail($request->id);
                $available = Order::count();
                return view('Admin.order', compact('available', 'order'));
            } else if ($usertype === 'pending') {
                return view('pending');
            }
        } else {
            return view('auth.login');
        }

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
        $writer= auth()->user();
        $available=Order::count();
        $bidCount = Bid::where('writer_id', $writer->id)->count();
        $myorder= MyOrder::where('writer_id', $writer->id)->where('status', 'current')->get();
        return view('Writers.current', compact('bidCount', 'available', 'myorder'));
    }

    public function Dispute()
    {
        return view('Writers.Dispute');
    }

    public function order(Request $request)
    {
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;

            if ($usertype === 'writer') {
                $order = Order::findOrFail($request->id);
                $bidder = auth()->user();
                $bidCount=Bid::count();

                // Find the bid for the current user and order
                $bid = Bid::where('OrderId', $order->id)
                    ->where('writer_id', auth()->user()->id)
                    ->first();

                $existingBid = Bid::where('OrderId', $order->id)
                    ->where('writer_id', $bidder->id)
                    ->first();

                $available = Order::count();
                return view('Writers.order', compact('available', 'order', 'bid', 'existingBid', 'bidCount'));
            } else if ($usertype === 'admin') {
                $order = Order::findOrFail($request->id);
                $available = Order::count();
                return view('Admin.order', compact('available', 'order'));
            } else if ($usertype === 'pending') {
                return view('pending');
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
                $available= Order::count();
                return view('Writers.prohibited');
            } else {
                $available= Order::count();
                return view('Admin.New_order', compact('available'));
            }
        } else {
            return view('auth.login');
        }

    }

    public function new_files(Request $request)
    {
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;

            if ($usertype != 'admin') {
                return view('Writers.new_files');
            } else {
                $available=Order::count();
                $order=Order::find($request->id);
                return view('Admin.file_upload', compact('order', 'available'));
            }
        } else {
            return view('auth.login');
        }

    }
}
