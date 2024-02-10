<?php

namespace App\Http\Controllers;

use App\Models\MyOrder;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SupportController extends Controller
{
    public function changeUser(Request $request)
    {
        try {
            $user = User::find($request->id);

            if (!$user) {
                Alert::error('Error!', 'No such user exists');
                return redirect()->back()->with('error', 'No such user exists');
            }

            $user->usertype = $request->usertype;
            $user->update();

            Alert::success('Success', 'User changed successfully')->persistent();
            return redirect()->back()->with('success', 'User changed successfully');
        } catch (\Exception $e) {


            Alert::error("error!", $e->getMessage())->persistent();
            return redirect()->back()->with('error', 'Failed to process the order');
        }
    }

    public function deleteUser(Request $request)
    {
        $user = User::find($request->id);

        if (!$user) {
            Alert::error('Error!', 'No such user exists');
            return redirect()->back()->with('error', 'No such user exists');
        }

        //$user->usertype = $request->usertype;
        $user->delete();

        Alert::success('Success', 'User deletec successfully')->persistent();
        return redirect()->back()->with('success', 'User changed successfully');

    }

    public function ReviseOrder(Request $request)
    {
        $order = Order::with(['available', 'bids', 'myOrder', 'messages'])->find($request->OrderId);

        if ($order) {
            // Update the status to "revision" in the MyOrder model
            MyOrder::where('OrderId', $order->id)->update(['status' => 'revision']);

            // You can redirect or return a response as needed
            Alert::success('success', 'order placed back to revision');
            return redirect()->back()->with('success', 'Order revised successfully.');
        } else {
            // Handle the case when the order is not found
            // You might want to redirect or display an error message
            Alert::error('error!','no such order found');
            return redirect()->back()->with('error', 'Order not found.');
        }

    }

}
