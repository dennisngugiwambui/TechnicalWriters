<?php

namespace App\Http\Controllers;

use App\Models\Available;
use App\Models\Bid;
use App\Models\MyOrder;
use App\Models\Order;
use App\Models\User;
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

            if ($usertype === 'writer') {
                $writer = auth()->user();
                $order=Available::all();
                $available= Available::count();
                $current = MyOrder::where('writer_id', $writer->id)->whereIn('status', ['current'])->count();
                $bidCount=Bid::count();
                return view('Writers.index', compact('order', 'available', 'bidCount', 'current'));
            } else if ($usertype=== 'admin'){
                $order=Available::all();
                $available= Available::count();
                $current = MyOrder::count();
                return view('Admin.available', compact('available', 'order', 'current'));
            }else if ($usertype === 'pending') {
                return view('pending');
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
                $available=Available::count();
                $bidCount=Bid::count();
                $bidder=auth()->user();
                if (!$bidder || $bidder->usertype !== 'writer') {

                    Alert::success('success', 'this order is only visible to owner writer');
                    return redirect()->route('home')->with('error', 'You are not authorized to view bids.');
                }
                $current = MyOrder::where('writer_id', $bidder->id)->whereIn('status', ['current'])->count();
                $bids=Bid::where('writer_id', $bidder->id)->get();
                return view('Writers.Bids', compact('bidCount', 'bids', 'available', 'current'));
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

    public function current(Request $request)
    {

        if (Auth::id()) {
            $usertype = Auth::user()->usertype;

            if ($usertype === 'writer') {
                $writer = auth()->user();
                $current = MyOrder::where('writer_id', $writer->id)->whereIn('status', ['current'])->count();
                $available = Available::count();
                $bidCount = Bid::where('writer_id', $writer->id)->count();
                $myorder = MyOrder::where('writer_id', $writer->id)->where('status', 'current')->get();
                $delivered = MyOrder::where('writer_id', $writer->id)->whereIn('status', ['delivered', 'done'])->get();
                return view('Admin.current', compact('bidCount', 'current','available', 'myorder'));
            } else if ($usertype === 'admin') {
                $order = Order::all();
                $current = MyOrder::count();
                $available = Available::count();
                $bidCount = Bid::count();
                $ongoing=MyOrder::where('status', 'current')->get();
                $delivered = MyOrder::whereIn('status', ['delivered', 'done'])->get();
                return view('Admin.current', compact('available', 'order', 'current', 'bidCount', 'current', 'ongoing'));
            } else if ($usertype === 'pending') {
                return view('pending');
            }
        } else {
            return view('auth.login');
        }

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
                $order = Available::findOrFail($request->OrderId);
                $bidder = auth()->user();
                $writer=auth()->user();
                $OrderId=Available::find($request->OrderId);
                $bidCount = Bid::where('writer_id', $writer->id)->count();

                Log::info('Received OrderId: ' . $order);

                $current = MyOrder::where('writer_id', $writer->id)->whereIn('status', ['delivered', 'done'])->get();

                // Find the bid for the current user and order
                $bid = Bid::where('OrderId', $order->id)
                    ->where('writer_id', auth()->user()->id)
                    ->first();

                $existingBid = Bid::where('OrderId', $order->id)
                    ->where('writer_id', $bidder->id)
                    ->first();

                $available = Available::count();
                return view('Writers.order', compact('available', 'order', 'bid', 'existingBid', 'bidCount', 'current', 'OrderId'));
            } else if ($usertype === 'admin') {
                $order = Order::findOrFail($request->id);
                $available = Order::count();
                $bidCount = Bid::count();
                return view('Admin.order', compact('available', 'order', 'bidCount'));
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
                $writer=auth()->user();
                $current = MyOrder::where('writer_id', $writer->id)->whereIn('status', ['delivered', 'done'])->get();
                return view('Writers.prohibited' , compact('current', 'available', ''));
            } else {
                $available= Order::count();
                $bidCount=Bid::count();
                $current = MyOrder::count();
                $bidCount = Bid::count();
                return view('Admin.New_order', compact('available', 'current', 'bidCount'));
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
                $available=Available::count();
                $order=Order::find($request->id);
                $bidCount=Bid::count();
                $current = MyOrder::count();
                return view('Admin.file_upload', compact('order', 'available', 'bidCount', 'current'));
            }
        } else {
            return view('auth.login');
        }

    }

    public function users()
    {
        $users=User::where('status', 'pending')->get();
        $writers=User::where('usertype', 'writer')->get();
        $admin=User::where('status', 'admin')->get();
        $suspended=User::where('status', 'suspended')->get();
        $available=Available::count();
        $bidCount=Bid::count();
        $current = MyOrder::count();
        return view('Admin.change_users', compact('users', 'writers', 'admin', 'suspended', 'current', 'bidCount', 'available'));

    }
}
