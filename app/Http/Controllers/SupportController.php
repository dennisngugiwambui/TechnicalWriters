<?php

namespace App\Http\Controllers;

use AfricasTalking\SDK\AfricasTalking;
use App\Models\Available;
use App\Models\Bid;
use App\Models\MyOrder;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        try {
            $orders = Order::find($request->id);
            $revise = MyOrder::where('OrderId', $orders->id)->get();
            return response()->json($revise);
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the process
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }


    public function AssignOrders(Request $request)
    {
        try {
            $bid = Bid::where('OrderId', $request->OrderId)->first();
            $available=Available::where('OrderId', $request->OrderId)->get();
            $user = auth()->user();

            // Check if the order has already been assigned
            $existingOrder = MyOrder::where('OrderId', $request->OrderId)->first();

            if ($existingOrder) {
                Alert::error('error!', 'Order is already assigned')->persistent();
                return redirect()->back()->with('error', 'Order is already assigned');
            }



            $data=new MyOrder();

            $data->OrderId=$bid->OrderId;
            $data->assignmentType=$bid->assignmentType;
            $data->typeOfService=$bid->typeOfService;
            $data->topicTitle=$bid->topicTitle;
            $data->discipline=$bid->discipline;
            $data->pages=$bid->pages;
            $data->deadline=$bid->deadline;
            $data->cpp=$bid->cpp;
            $data->price=$bid->price;
            $data->comments=$bid->comments;
            $data->files=$bid->files;
            $data->writer_id=$bid->writer_id;
            $data->writer_name=$bid->writer_name;
            $data->writer_phone=$bid->writer_phone;

            //$data->status = 'assigned';

            $data->save();

            $bid->update(['status' => 'assigned']);

            // Update status in Available model
            foreach ($available as $entry) {
                $entry->status = 'assigned';
                $entry->save();
            }


            // Update status to 'unavailable' for other writers who had applied
            Bid::where('OrderId', $request->OrderId)
                ->where('writer_id', '!=', $bid->writer_id)
                ->update(['status' => 'unavailable']);



            Alert::success('success', 'order assigned to this writer');

            return redirect()->back()->with('success', 'order assigned successfully');

        }catch (\Exception $e) {
            Alert::error('error!', $e->getMessage())->persistent();
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }

    }


    public function sendSms(string $number, string $message)
    {
        $username = 'dennohosi';
        $apiKey   =  getenv('AT_API_KEY');
        $AT       = new AfricasTalking($username, $apiKey);


        // Get one of the services
        $sms      = $AT->sms();


        // Use the service
        $result   = $sms->send([
            'to'      => $number,
            'message' => $message,
        ]);


    }


    public function ChangeStatus(Request $request)
    {
        try {
            // Validate the request if needed

            $order = MyOrder::where('OrderId', $request->id)->first();

            if (!$order) {
                // Handle case where the order is not found
                return redirect()->back()->with('error', 'Order not found.');
            }

            // Update the status based on user selection
            // Update the status based on user selection
            if ($request->usertype == 'reassign') {
                // If reassign is selected, update Bid status to 'bid' and Available status to 'visible'
                $bids = Bid::where('OrderId', $request->id)->get();
                $available = Available::where('OrderId', $request->id)->first();

                foreach ($bids as $bid) {
                    $bid->update(['status' => 'bid']);
                }

                if ($available) {
                    $available->update(['status' => 'visible']);
                }
            }

            // Update MyOrder status
            $order->status = $request->usertype;
            $order->update();
             //return response()->json($bid);

            // Display success message
            Alert::success('Success', 'Order status changed successfully');

            // Redirect back with success message
            return redirect()->back()->with('success', 'Order status changed successfully');
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the process
            Alert::error('Error!', $e->getMessage())->persistent();
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }

    }




}
