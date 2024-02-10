<?php

namespace App\Http\Controllers;

use App\Models\Available;
use App\Models\Bid;
use App\Models\Message;
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
                $order=Available::all();
                $available= Order::count();
                $bidCount=Bid::count();
                $writer=auth()->user();
                $current = MyOrder::where('writer_id', $writer->id)->where('status', 'current')->count();

                return view('Writers.index', compact('order', 'available', 'bidCount', 'current'));
            } else if($usertype === 'admin') {
                $order=Available::all();
                $available= Available::count();
                $current = MyOrder::where('status', 'current')->count();
                $myrevision = MyOrder::where('status', 'revision')->count();

                return view('Admin.available', compact('available', 'order', 'current', 'myrevision'));
            }else if($usertype === 'pending')
            {
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
                $available=Order::count();
                $bidCount=Bid::count();
                $bidder=auth()->user();
                if (!$bidder || $bidder->usertype !== 'writer') {

                    Alert::success('success', 'this order is only visible to owner writer');
                    return redirect()->route('home')->with('error', 'You are not authorized to view bids.');
                }
               // $writer=auth()->user();
                $current = MyOrder::where('writer_id', $bidder->id)->where('status', 'current')->count();
                $bids=Bid::where('writer_id', $bidder->id)->get();
                return view('Writers.Bids', compact('bidCount', 'bids', 'available', 'current'));
            } else if ($usertype === 'admin') {
                $order = Order::findOrFail($request->id);
                $available = Order::count();
                $myrevision = MyOrder::where('status', 'revision')->count();
                $current = MyOrder::where('status', 'current')->count();
                return view('Admin.order', compact('available', 'order', 'current', 'myrevision'));
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
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;

            if ($usertype === 'writer') {
                $bidder=auth()->user();
                $available=Order::count();
                $current = MyOrder::where('writer_id', $bidder->id)->where('status', 'current')->count();
                $myrevision = MyOrder::where('writer_id', $bidder->id)->where('status', 'revision')->count();
                $revision = MyOrder::where('writer_id', $bidder->id)->where('status', 'revision')->get();
                $bidCount = Bid::where('writer_id', $bidder->id)->count();
                return view('Writers.Revision', compact('current', 'available', 'bidCount', 'revision', 'myrevision'));
            } else if ($usertype === 'admin') {
                $bidder=auth()->user();
                $available=Order::count();
                $current = MyOrder::where('writer_id', $bidder->id)->where('status', 'current')->count();
                $bidCount = Bid::where('writer_id', $bidder->id)->count();
                $revision=MyOrder::where('status', 'revision')->get();
                $myrevision = MyOrder::where('status', 'revision')->count();
                return view('Admin.Revision', compact('current', 'available', 'bidCount', 'revision', 'myrevision'));
            } else if ($usertype === 'pending') {
                return view('pending');
            }else if($usertype === 'suspended')
            {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Your account is suspended. Please contact support for further assistance.');
            }
        } else {
            return view('auth.login');
        }

    }

    public function current()
    {
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;

            if ($usertype === 'writer') {
                $writer= auth()->user();
                $available=Order::count();
                $bidCount = Bid::where('writer_id', $writer->id)->count();
                $myorder= MyOrder::where('writer_id', $writer->id)->get();
                $writer=auth()->user();
                $current = MyOrder::where('writer_id', $writer->id)->where('status', 'current')->count();

                return view('Writers.current', compact('bidCount', 'available', 'myorder', 'current'));
            } else if ($usertype === 'admin') {
                $writer= auth()->user();
                $available=Available::count();
                $order=Order::where('status', 'visible')->get();
                $bidCount = Bid::where('writer_id', $writer->id)->count();
                $myorder= MyOrder::where('writer_id', $writer->id)->get();
                $writer=auth()->user();
                $current = MyOrder::where('writer_id', $writer->id)->where('status', 'current')->count();
                $onprogress=MyOrder::where('status', 'current')->get();
                $myrevision = MyOrder::where('status', 'revision')->count();
                return view('Admin.current', compact('bidCount', 'available', 'myorder', 'current', 'order', 'onprogress', 'myrevision'));
            } else if ($usertype === 'pending') {
                return view('pending');
            }else if($usertype === 'suspended')
            {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Your account is suspended. Please contact support for further assistance.');
            }
        } else {
            return view('auth.login');
        }

    }

    public function Dispute()
    {
        $bidder=auth()->user();
        $myrevision = MyOrder::where('status', 'revision')->count();
        $current = MyOrder::where('writer_id', $bidder->id)->where('status', 'current')->count();
        return view('Writers.Dispute', compact('current', 'myrevision'));
    }

    public function order(Request $request)
    {
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;

            if ($usertype === 'writer') {
                // Find the order with associated data
                $order = Order::with(['available', 'bids', 'myOrder', 'messages'])
                    ->find($request->OrderId);

                if ($order) {
                    $available = Available::count();
                    $current = MyOrder::where('status', 'current')->count();
                    $bidCount = Bid::count();
                    $bidder = auth()->user();

                    // Find the bid for the current user and order
                    $bid = $order->bids
                        ->where('writer_id', $bidder->id)
                        ->first();

                    // Check if the current user has an existing bid
                    $existingBid = $order->bids
                        ->where('writer_id', $bidder->id)
                        ->first();
                    $messages = Message::where('orderId', $request->OrderId)->get();

                    return view('Writers.order', compact('order', 'available', 'current', 'bidCount', 'existingBid', 'bid', 'bidCount', 'messages'));
                } else {
                    // Handle the case when the order is not found
                    // You might want to redirect or display an error message
                    return redirect()->back()->with('error', 'Order not found.');
                }
            } elseif ($usertype === 'admin') {
                // Assuming you want to retrieve data related to the Order for the admin as well
                $order = Order::with(['available', 'bids', 'myOrder'])
                    ->find($request->OrderId);

                if ($order) {
                    $available = Available::count();
                    $current = MyOrder::where('status', 'current')->count();
                    $bidCount = Bid::count();
                    $myrevision = MyOrder::where('status', 'revision')->count();

                    return view('Admin.order', compact('order', 'available', 'current', 'bidCount', 'myrevision'));
                } else {
                    // Handle the case when the order is not found
                    // You might want to redirect or display an error message
                    return redirect()->back()->with('error', 'Order not found.');
                }
            } elseif ($usertype === 'pending') {
                return view('pending');
            } elseif ($usertype === 'suspended') {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Your account is suspended. Please contact support for further assistance.');
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
                $available= Available::count();
                $current = MyOrder::where('status', 'current')->count();
                $myrevision = MyOrder::where('status', 'revision')->count();
                return view('Admin.New_order', compact('available', 'current', 'myrevision'));
            }
        } else {
            return view('auth.login');
        }

    }

    public function order_details(Request $request)
    {
        $order=Available::find($request->OrderId);
        $available= Available::count();
        $current = MyOrder::where('status', 'current')->count();
        $bidCount=Bid::count();
        return view('Admin.order', compact('order', 'available', 'current', 'bidCount'));

    }

    public function new_files(Request $request)
    {
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;

            if ($usertype != 'admin') {
                return view('Writers.new_files');
            } else {
                $current = MyOrder::where('status', 'current')->count();
                $available=Order::count();
                $order=Order::find($request->id);
                $myrevision = MyOrder::where('status', 'revision')->count();
                return view('Admin.file_upload', compact('order', 'available', 'current', 'myrevision'));
            }
        } else {
            return view('auth.login');
        }

    }

    public function users()
    {
        $users=User::all();
        $current = MyOrder::where('status', 'current')->count();
        $available=Order::count();
        //$order=Order::find($request->id);
        $myrevision = MyOrder::where('status', 'revision')->count();
        return view('Admin.change_users', compact('users', 'available', 'current', 'myrevision'));

    }
}
