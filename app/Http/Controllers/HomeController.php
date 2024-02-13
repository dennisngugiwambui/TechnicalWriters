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
                $order = Available::where('status', 'visible')->get();
                $available = Available::where('status', 'visible')->count();
                //$bidCount = Bid::where('writer_id', $bidder->id)->count();
                $writer = auth()->user();
                $bidCount = Bid::where('writer_id', $writer->id)->count();
                $current = MyOrder::where('writer_id', $writer->id)->where('status', 'current')->count();
                $disputeCount = MyOrder::where('writer_id', $writer->id)->whereIn('status', ['dispute'])->count();
                $myrevision = MyOrder::where('writer_id', $writer->id)->where('status', 'revision')->count();
                $finishedCount = MyOrder::where('writer_id', $writer->id)->where('status', 'finished')->count();

                return view('Writers.index', compact('order', 'available', 'bidCount', 'current', 'disputeCount', 'myrevision', 'finishedCount'));
            } else if ($usertype === 'admin') {
                $order = Available::where('status', 'visible')->get();
                $available = Available::where('status', 'visible')->count();
                $current = Order::where('status', 'visible')->count();
                $bidCount = Bid::where('status', 'bid')->count();

                $myrevision = MyOrder::where('status', 'revision')->count();

                return view('Admin.available', compact('available', 'order', 'current', 'myrevision', 'bidCount'));
            } else if ($usertype === 'pending') {
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
                $available = Available::where('status', 'visible')->count();
                //$bidCount = Bid::where('writer_id', $bidder->id)->count();
                $bidder = auth()->user();
                if (!$bidder || $bidder->usertype !== 'writer') {

                    Alert::success('success', 'this order is only visible to owner writer');
                    return redirect()->route('home')->with('error', 'You are not authorized to view bids.');
                }
                $bidCount = Bid::where('writer_id', $bidder->id)->whereIn('status', ['bid'])->count();

                $current = MyOrder::where('writer_id', $bidder->id)->where('status', 'current')->count();
                $disputeCount = MyOrder::where('writer_id', $bidder->id)->whereIn('status', ['dispute'])->count();
                $bids = Bid::where('writer_id', $bidder->id)->whereIn('status', ['bid'])->get();
                $myrevision = MyOrder::where('writer_id', $bidder->id)->where('status', 'revision')->count();
                $finishedCount = MyOrder::where('writer_id', $bidder->id)->where('status', 'finished')->count();
                $disputeCount = MyOrder::where('writer_id', $bidder->id)->whereIn('status', ['dispute'])->count();


                return view('Writers.Bids', compact('bidCount', 'bids', 'available', 'current', 'myrevision', 'finishedCount', 'disputeCount'));
            } else if ($usertype === 'admin') {
                //$order = Order::findOrFail($request->id);
                $available = Available::where('status', 'visible')->count();
                $myrevision = MyOrder::where('status', 'revision')->count();
                $current = Order::where('status', 'visible')->count();
                $bids = Bid::where('status', 'bid')->get();
                $disputeCount=MyOrder::where('status', 'dispute')->count();
                $finishedCount=MyOrder::where('status', 'finished')->count();
                $bidCount=Bid::count();

                return view('Admin.Bids', compact('available', 'current', 'myrevision', 'bids', 'disputeCount', 'finishedCount', 'bidCount'));
            } else if ($usertype === 'pending') {
                return view('pending');
            }
        } else {
            return view('auth.login');
        }

    }

    public function Finished()
    {
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;

            if ($usertype === 'writer') {

                $writer = auth()->user();
                $available = Available::where('status', 'visible')->count();
                $bidCount = Bid::where('writer_id', $writer->id)->count();
                $completed = MyOrder::where('writer_id', $writer->id)->where('status', 'finished')->get();
                $disputeCount = MyOrder::where('writer_id', $writer->id)->whereIn('status', ['dispute'])->count();
                $current = MyOrder::where('writer_id', $writer->id)->where('status', 'current')->count();
                $myrevision = MyOrder::where('writer_id', $writer->id)->where('status', 'revision')->count();
                $finishedCount = MyOrder::where('writer_id', $writer->id)->where('status', 'finished')->count();

                return view('Writers.Finished', compact('disputeCount', 'bidCount', 'completed', 'available', 'current', 'myrevision', 'finishedCount'));

            }else if ($usertype == 'admin'){
                $available = Available::where('status', 'visible')->count();
                $bidCount = Bid::where('status', 'bid')->count();
                $completed = MyOrder::where('status', 'finished')->get();
                $disputeCount = MyOrder::where('status', ['dispute'])->count();
                $current = MyOrder::where('status', 'current')->count();
                $myrevision = MyOrder::where('status', 'revision')->count();
                $finishedCount = MyOrder::where('status', 'finished')->count();

                return view('Admin.Finished', compact('disputeCount', 'bidCount', 'completed', 'available', 'current', 'myrevision', 'finishedCount'));

            }
        }
    }

    public function revision()
    {
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;

            if ($usertype === 'writer') {
                $bidder = auth()->user();
                $available = Available::where('status', 'visible')->count();
                $current = MyOrder::where('writer_id', $bidder->id)->where('status', 'current')->count();
                $myrevision = MyOrder::where('writer_id', $bidder->id)->where('status', 'revision')->count();
                $revision = MyOrder::where('writer_id', $bidder->id)->where('status', 'revision')->get();
                $bidCount = Bid::where('writer_id', $bidder->id)->count();
                $disputeCount = MyOrder::where('writer_id', $bidder->id)->whereIn('status', ['dispute'])->count();
                $finishedCount = MyOrder::where('writer_id', $bidder->id)->where('status', 'finished')->count();


                return view('Writers.Revision', compact('current', 'available', 'bidCount', 'revision', 'myrevision', 'disputeCount', 'finishedCount'));
            } else if ($usertype === 'admin') {
                $bidder = auth()->user();
                $available = Available::where('status', 'visible')->count();
                $current = Order::where('status', 'visible')->count();
                $bidCount = Bid::where('writer_id', $bidder->id)->count();
                $revision = MyOrder::where('status', 'revision')->get();
                $myrevision = MyOrder::where('status', 'revision')->count();
                $finishedCount = MyOrder::where('writer_id', $bidder->id)->where('status', 'finished')->count();


                return view('Admin.Revision', compact('current', 'available', 'bidCount', 'revision', 'myrevision', 'finishedCount'));
            } else if ($usertype === 'pending') {
                return view('pending');
            } else if ($usertype === 'suspended') {
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
                $writer = auth()->user();
                $available = Available::where('status', 'visible')->count();
                $bidCount = Bid::where('writer_id', $writer->id)->count();
                $myorder = MyOrder::where('writer_id', $writer->id)->where('status', 'current')->get();
                $writer = auth()->user();
                $current = MyOrder::where('writer_id', $writer->id)->where('status', 'current')->count();
                $delivered = MyOrder::where('writer_id', $writer->id)->where('status', ['done', 'delivered'])->get();
                $deliveredCount = MyOrder::where('writer_id', $writer->id)->where('status', ['done', 'delivered'])->count();
                $assignedCount = MyOrder::where('writer_id', $writer->id)->where('status', 'current')->count();
                $disputeCount = MyOrder::where('writer_id', $writer->id)->whereIn('status', ['dispute'])->count();
                $myrevision = MyOrder::where('writer_id', $writer->id)->where('status', 'revision')->count();
                $finishedCount = MyOrder::where('writer_id', $writer->id)->where('status', 'finished')->count();

                return view('Writers.current', compact('bidCount', 'available', 'myorder', 'current', 'delivered', 'deliveredCount', 'assignedCount', 'disputeCount', 'myrevision', 'finishedCount'));
            } else if ($usertype === 'admin') {
                $available = Available::where('status', 'visible')->count();
                $order = Order::where('status', 'visible')->get();
                $bidCount = Bid::where('status','bid')->count();
                $myorder = MyOrder::where('status', 'current')->get();
                $current = Order::where('status','visible')->count();
                $assignedOrders=MyOrder::where('status', 'current')->count();
                $onprogress = MyOrder::where('status', 'current')->get();
                $myrevision = MyOrder::where('status', 'revision')->count();
                return view('Admin.current', compact('bidCount', 'available', 'myorder', 'current', 'order', 'onprogress', 'myrevision', 'assignedOrders'));
            } else if ($usertype === 'pending') {
                return view('pending');
            } else if ($usertype === 'suspended') {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Your account is suspended. Please contact support for further assistance.');
            }
        } else {
            return view('auth.login');
        }

    }

    public function Dispute()
    {
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;

            if ($usertype === 'writer') {
                $bidder = auth()->user();
                $writerId = $bidder->id;

                $available = Available::where('status', 'visible')->count();
                $bidCount = Bid::where('writer_id', $writerId)->count();

                $currentOrders = Order::where('writer_id', $writerId)->where('status', 'visible')->get();
                $current = $currentOrders->count();

                $myRevisions = MyOrder::where('writer_id', $writerId)->where('status', 'revision')->get();
                $myrevision = $myRevisions->count();

//                $dispute = MyOrder::where('writer_id', $writerId)->whereIn('status', ['dispute'])->get();
//                $disputeCount = MyOrder::where('writer_id', $writerId)->whereIn('status', ['dispute'])->count();
                $dispute = MyOrder::where('writer_id', $writerId)->whereIn('status', ['dispute'])->get();
                $disputeCount = MyOrder::where('writer_id', $writerId)->whereIn('status', ['dispute'])->count();
                $finishedCount = MyOrder::where('writer_id', $writerId)->where('status', 'finished')->count();

                return view('Writers.Dispute', compact('myrevision', 'dispute', 'available', 'bidCount', 'disputeCount', 'current', 'finishedCount'));
            } else if ($usertype === 'admin') {
                //$bidder=auth()->user();
                $available = Available::where('status', 'visible')->count();
                $bidCount = Bid::count();
                $myrevision = MyOrder::where('status', 'revision')->count();
                $current = Order::where('status', 'visible')->count();
                $dispute = MyOrder::whereIn('status', ['dispute'])->get();
                $disputeCount = MyOrder::where('status', 'dispute')->count();
                return view('Admin.Dispute', compact('current', 'myrevision', 'dispute', 'available', 'bidCount', 'disputeCount'));
            } else if ($usertype === 'pending') {
                return view('pending');
            } elseif ($usertype === 'suspended') {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Your account is suspended. Please contact support for further assistance.');
            }
        } else {
            return view('auth.login');
        }
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
                    $available = Available::where('status', 'visible')->count();
                    $current = MyOrder::where('status', 'current')->count();

                    $bidder = auth()->user();
                    $bidCount = Bid::where('writer_id', $bidder->id)->count();

                    // Find the bid for the current user and order
                    $bid = $order->bids
                        ->where('writer_id', $bidder->id)
                        ->first();

                    // Check if the current user has an existing bid
                    $existingBid = $order->bids
                        ->where('writer_id', $bidder->id)
                        ->first();
                    $messages = Message::where('orderId', $request->OrderId)->orderBy('created_at', 'desc')->get();
                    $disputeCount = MyOrder::whereIn('status', ['dispute'])->count();
                    $myrevision = MyOrder::where('writer_id', $bidder->id)->where('status', 'revision')->count();
                    $finishedCount = MyOrder::where('writer_id', $bidder->id)->where('status', 'finished')->count();

                    return view('Writers.order', compact('order', 'available', 'current', 'bidCount', 'existingBid', 'bid', 'bidCount', 'messages', 'disputeCount', 'myrevision', 'finishedCount'));
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
                    $available = Available::where('status', 'visible')->count();
                    $current = Order::where('status', 'visible')->count();
                    $bidCount = Bid::count();
                    $myrevision = MyOrder::where('status', 'revision')->count();
                    $messages = Message::where('orderId', $request->OrderId)->get();

                    return view('Admin.order', compact('order', 'available', 'current', 'bidCount', 'myrevision', 'messages'));
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
                $available = Available::where('status', 'visible')->count();
                return view('Writers.prohibited');
            } else {
                $available = Available::where('status', 'visible')->count();
                $current = Order::where('status', 'visible')->count();
                $myrevision = MyOrder::where('status', 'revision')->count();
                $bidCount=Bid::where('status', 'bid')->count();
                return view('Admin.New_order', compact('available', 'current', 'myrevision', 'bidCount'));
            }
        } else {
            return view('auth.login');
        }

    }

    public function order_details(Request $request)
    {
        $order = Available::find($request->OrderId);
        $available = Available::where('status', 'visible')->count();
        $current = Order::where('status', 'visible')->count();
        $bidCount = Bid::count();
        return view('Admin.order', compact('order', 'available', 'current', 'bidCount'));

    }

    public function new_files(Request $request)
    {
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;

            if ($usertype != 'admin') {
                return view('Writers.new_files');
            } else {
                $current = Order::where('status', 'visible')->count();
                $available = Available::where('status', 'visible')->count();
                $order = Order::find($request->id);
                $myrevision = MyOrder::where('status', 'revision')->count();
                $bidCount = Bid::where('status', 'bid')->count();
                return view('Admin.file_upload', compact('order', 'available', 'current', 'myrevision', 'bidCount'));
            }
        } else {
            return view('auth.login');
        }

    }

    public function users()
    {
        $users = User::all();
        $current = Order::where('status', 'visible')->count();
        $available = Available::where('status', 'visible')->count();
        //$order=Order::find($request->id);
        $bidCount=Bid::where('status','bid')->count();
        $myrevision = MyOrder::where('status', 'revision')->count();
        return view('Admin.change_users', compact('users', 'available', 'current', 'myrevision', 'bidCount'));

    }

    public function home()
    {
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;

            if ($usertype === 'writer') {
                $order = Available::where('status', 'visible')->get();
                $available = Available::where('status', 'visible')->count();
                //$bidCount = Bid::where('writer_id', $bidder->id)->count();
                $writer = auth()->user();
                $bidCount = Bid::where('writer_id', $writer->id)->count();
                $current = MyOrder::where('writer_id', $writer->id)->where('status', 'current')->count();
                $disputeCount = MyOrder::where('writer_id', $writer->id)->whereIn('status', ['dispute'])->count();
                $myrevision = MyOrder::where('writer_id', $writer->id)->where('status', 'revision')->count();
                $finishedCount = MyOrder::where('writer_id', $writer->id)->where('status', 'finished')->count();

                return view('Writers.index', compact('order', 'available', 'bidCount', 'current', 'disputeCount', 'myrevision', 'finishedCount'));
            } else if ($usertype === 'admin') {
                $order = Available::all();
                $available = Available::where('status', 'visible')->count();
                $current = Order::where('status', 'visible')->count();

                $myrevision = MyOrder::where('status', 'revision')->count();

                return view('Admin.available', compact('available', 'order', 'current', 'myrevision'));
            } else if ($usertype === 'pending') {
                return view('pending');

            }
        } else {
            return view('auth.login');
        }

    }


    public function profile()
    {
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;

            if ($usertype === 'writer') {
                $available = Available::where('status', 'visible')->count();
                //$bidCount = Bid::where('writer_id', $bidder->id)->count();
                $writer = auth()->user();
                $bidCount = Bid::where('writer_id', $writer->id)->count();
                $current = MyOrder::where('writer_id', $writer->id)->where('status', 'current')->count();
                $disputeCount = MyOrder::where('writer_id', $writer->id)->whereIn('status', ['dispute'])->count();
                $myrevision = MyOrder::where('writer_id', $writer->id)->where('status', 'revision')->count();
                $finishedCount = MyOrder::where('writer_id', $writer->id)->where('status', 'finished')->count();
                //$completedOrders= MyOrder::where('writer_id', $writer->id)->where('status', 'finished')->count();

                return view('Writers.profile', compact('available', 'bidCount', 'current', 'disputeCount', 'myrevision', 'finishedCount'));

            }else if($usertype === 'admin') {
                $available = Available::where('status', 'visible')->count();
                //$bidCount = Bid::where('writer_id', $bidder->id)->count();
                $writer = auth()->user();
                $bidCount = Bid::where('writer_id', $writer->id)->count();
                $current = MyOrder::where('writer_id', $writer->id)->where('status', 'current')->count();
                $disputeCount = MyOrder::where('writer_id', $writer->id)->whereIn('status', ['dispute'])->count();
                $myrevision = MyOrder::where('writer_id', $writer->id)->where('status', 'revision')->count();
                $finishedCount = MyOrder::where('status', 'finished')->count();
                $users=User::all();
                $AllUsers=User::count();


                return view('Admin.Profile', compact('available', 'bidCount', 'current', 'disputeCount', 'myrevision', 'finishedCount', 'users', 'AllUsers'));

            }else if  ($usertype === 'pending')
            {
                return view('pending');
            }
            else if ($usertype === 'suspended')
            {

            }
        }else  {
            return view('auth.login');
        }

    }

    public function AssignOrdera()
    {
        $orders = Order::with(['available', 'bids', 'myOrder', 'messages'])->get();

//        $bidsGroupedByOrderId = $orders->map(function ($order) {
//            return [
//                'OrderId' => $order->id,
//                'bids' => Bid::where('status', 'bid')->where('OrderId', $order->id)->get()->groupBy('OrderId'),
//            ];
//        });

        // Fetch bids with status 'bid'
        $bids = Bid::where('status', 'bid')->get();

        // Group bids by order ID
        $bidsGroupedByOrderId = $bids->groupBy('OrderId');
        //$biddedOrder=Bid::where('status', 'bid')->groupBy('OrderId')->get();

        $available = Available::where('status', 'visible')->count();
        //$bidCount = Bid::where('writer_id', $bidder->id)->count();
        $writer = auth()->user();
        $bidCount = Bid::where('writer_id', $writer->id)->count();
        $current = MyOrder::where('writer_id', $writer->id)->where('status', 'current')->count();
        $disputeCount = MyOrder::where('writer_id', $writer->id)->whereIn('status', ['dispute'])->count();
        $myrevision = MyOrder::where('writer_id', $writer->id)->where('status', 'revision')->count();
        $finishedCount = MyOrder::where('status', 'finished')->count();

       // return response()->json($bidsGroupedByOrderId);

       // return response()->json($bidsGroupedByOrderId);

        return view('Admin.AssignOrders', compact('bidsGroupedByOrderId', 'available', 'bidCount', 'myrevision', 'current', 'finishedCount', 'disputeCount'));
    }

    public function AssignedOrder(Request $request)
    {
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;
            $assignedOrder = MyOrder::where('OrderId', $request->id)->first();

            if ($usertype === 'writer') {
                $available = Available::where('status', 'visible')->count();
                //$bidCount = Bid::where('writer_id', $bidder->id)->count();
                $writer = auth()->user();
                $bidCount = Bid::where('writer_id', $writer->id)->count();
                $current = MyOrder::where('writer_id', $writer->id)->where('status', 'current')->count();
                $disputeCount = MyOrder::where('writer_id', $writer->id)->whereIn('status', ['dispute'])->count();
                $myrevision = MyOrder::where('writer_id', $writer->id)->where('status', 'revision')->count();
                $finishedCount = MyOrder::where('writer_id', $writer->id)->where('status', 'finished')->count();
                //$completedOrders= MyOrder::where('writer_id', $writer->id)->where('status', 'finished')->count();
                $messages = Message::where('orderId', $request->OrderId)->orderBy('created_at', 'desc')->get();
                $orders = Order::with(['available', 'bids', 'myOrder', 'messages'])
                    ->find($request->OrderId);
                $order=$orders->myOrder;

                return view('Writers.AssignedOrders', compact('assignedOrder', 'available', 'current', 'myrevision', 'finishedCount', 'disputeCount', 'bidCount', 'messages', 'order'));
            } else if ($usertype == 'admin') {
                //$order=MyOrder::where('status', 'current')->get();
                $getOrder = Order::find($request->id);
                $messages = Message::where('orderId', $request->OrderId)->orderBy('created_at', 'desc')->get();
                $available = Available::where('status', 'visible')->count();
                //$bidCount = Bid::where('writer_id', $bidder->id)->count();
                $writer = auth()->user();
                $bidCount = Bid::where('writer_id', $writer->id)->count();
                $current = MyOrder::where('status', 'current')->count();
                $orders = MyOrder::where('status', 'current')->where('OrderId', $request->id)->get();
                $disputeCount = MyOrder::where('writer_id', $writer->id)->whereIn('status', ['dispute'])->count();
                $myrevision = MyOrder::where('writer_id', $writer->id)->where('status', 'revision')->count();
                $finishedCount = MyOrder::where('status', 'finished')->count();
                $order = Order::with(['available', 'bids', 'myOrder', 'messages'])
                    ->find($request->OrderId);


                return view('Admin.AssignedOrders', compact('assignedOrder', 'available', 'current', 'myrevision', 'finishedCount', 'disputeCount', 'bidCount', 'messages', 'order', 'orders'));

            }else if ($usertype === 'pending') {
                return view('pending');
            }
        }else {
            return view('auth.login');
        }
    }

    public function Messages(Request $request)
    {
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;
            $assignedOrder = MyOrder::where('OrderId', $request->id)->first();

            if ($usertype === 'writer') {
                $order = Order::with(['available', 'bids', 'myOrder', 'messages'])
                    ->find($request->OrderId);


                    $available = Available::where('status', 'visible')->count();
                    $current = MyOrder::where('status', 'current')->count();

                    $bidder = auth()->user();
                    $bidCount = Bid::where('writer_id', $bidder->id)->count();


                $authUser = auth()->user();

                $messages = Message::where(function ($query) use ($authUser) {
                        $query->where('from', $authUser->name)
                            ->orWhere('to', $authUser->name);
                    })
                    ->orderBy('created_at', 'desc')
                    ->get();
                    $disputeCount = MyOrder::whereIn('status', ['dispute'])->count();
                    $myrevision = MyOrder::where('writer_id', $bidder->id)->where('status', 'revision')->count();
                    $finishedCount = MyOrder::where('writer_id', $bidder->id)->where('status', 'finished')->count();

                    return view('Writers.Messages', compact('order', 'available', 'current', 'bidCount', 'bidCount', 'messages', 'disputeCount', 'myrevision', 'finishedCount'));
            }else if ($usertype == 'admin') {
                //$order=MyOrder::where('status', 'current')->get();
                $getOrder = Order::find($request->id);
                $messages = Message::where('orderId', $request->OrderId)->orderBy('created_at', 'desc')->get();
                $available = Available::where('status', 'visible')->count();
                //$bidCount = Bid::where('writer_id', $bidder->id)->count();
                $writer = auth()->user();
                $bidCount = Bid::where('writer_id', $writer->id)->count();
                $current = MyOrder::where('status', 'current')->count();
                $orders = MyOrder::where('status', 'current')->where('OrderId', $request->id)->get();
                $disputeCount = MyOrder::where('writer_id', $writer->id)->whereIn('status', ['dispute'])->count();
                $myrevision = MyOrder::where('writer_id', $writer->id)->where('status', 'revision')->count();
                $finishedCount = MyOrder::where('status', 'finished')->count();
                $order = Order::with(['available', 'bids', 'myOrder', 'messages'])
                    ->find($request->OrderId);


                return view('Admin.Messages', compact('assignedOrder', 'available', 'current', 'myrevision', 'finishedCount', 'disputeCount', 'bidCount', 'messages', 'order', 'orders'));

            }else if ($usertype === 'pending') {
                return view('pending');
            }
        }else {
            return view('auth.login');
        }

    }

    public function Payment(Request $request)
    {


        $available = Available::where('status', 'visible')->count();
        //$bidCount = Bid::where('writer_id', $bidder->id)->count();
        $writer = auth()->user();
        $bidCount = Bid::where('writer_id', $writer->id)->count();
        $current = MyOrder::where('writer_id', $writer->id)->where('status', 'current')->count();
        $disputeCount = MyOrder::where('writer_id', $writer->id)->whereIn('status', ['dispute'])->count();
        $myrevision = MyOrder::where('writer_id', $writer->id)->where('status', 'revision')->count();
        $finishedCount = MyOrder::where('writer_id', $writer->id)->where('status', 'finished')->count();
        //$completedOrders= MyOrder::where('writer_id', $writer->id)->where('status', 'finished')->count();
        $messages = Message::where('orderId', $request->OrderId)->orderBy('created_at', 'desc')->get();

        return view('Writers.Payment', compact( 'available', 'current', 'myrevision', 'finishedCount', 'disputeCount', 'bidCount', 'messages'));

    }
}
