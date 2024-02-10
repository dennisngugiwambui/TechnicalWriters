<?php

namespace App\Http\Controllers;

use App\Models\Available;
use App\Models\Bid;
use App\Models\Files;
use App\Models\Message;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;


class DataController extends Controller
{
    public function orders(Request $request)
    {
        try {
            $user = auth()->user();

            $this->validate($request, [
                'assignmentType' => 'required',
                'typeOfService' => 'required',
                'topicTitle' => 'required',
                'discipline' => 'required',
                'pages' => 'required|numeric|min:1',
                'deadline' => 'required|date',
                'cpp' => 'required|numeric|min:0',
            ]);

            // Create a new Order instance
            $order = new Order();

            $order->assignmentType = $request->assignmentType;
            $order->typeOfService = $request->typeOfService;
            $order->topicTitle = $request->topicTitle;
            $order->discipline = $request->discipline;
            $order->pages = $request->pages;
            $order->deadline = $request->deadline;
            $order->cpp = $request->cpp;
            $order->price = $request->cost;
            $order->comments = $request->comment;
            $order->employee_id = $user->id;
            $order->employee_name = $user->name;
            $order->employee_phone = $user->phone;
            $order->writer_id = 'N/A';
            $order->writer_name = 'N/A';
            $order->writer_phone = 'N/A';
           // $request->file('file')->getClientOriginalExtension();

//            $image = $request->file('files');
//            $filename = time() . '.' . $image->getClientOriginalExtension();
//            $image->move(public_path('assignment'), $filename); // Use public_path to specify the public directory
//
//            $order->files = $filename;


//            $image = $request->file('files');
//            $imageContents = file_get_contents($image->path());
//            $base64Image = base64_encode($imageContents);
//            // Generate a unique identifier for the filename
//            $uniqueFilename = uniqid() . '.' . $image->getClientOriginalExtension();
//
//            file_put_contents(public_path('assignment') . '/' . $uniqueFilename, base64_decode($base64Image));
//
//            $order->files = $uniqueFilename;



            //dd($order);
           // return response()->json($order);

            $order->save();

            // Redirect or return a response as needed
            Alert::success('success', 'order uploaded successfully')->persistent();
            return redirect()->route('new_files', ['id' => $order->id])->with('success', 'order uploaded successfully');

        } catch (Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    public function files(Request $request)
    {
        try {
            $files = new Files();
            $order = Order::findOrFail($request->id); // Use findOrFail to handle null case
            $id = $request->id;

            $user = auth()->user();

            $files->assignmentId = $order->id;
            $files->employee_id = $user->id;
            $files->employee_name = $user->name;
            $files->employee_phone = $user->phone;
            // Get the contents of the file as a base64-encoded string
            $base64Content = base64_encode(file_get_contents($request->file('files')->path()));

            // Trim the base64 string to a maximum length of 10 characters
            $trimmedBase64 = Str::limit($base64Content, 10, '');

            // Set the trimmed base64 string as the files attribute
            $files->files = $trimmedBase64;
            // Save the files record
            $files->save();

            return redirect()->back()->with('success', 'Files uploaded successfully');
        } catch (\Exception $e) {
            // Handle the exception, log, or redirect with an error message
            Alert::error('error!', $e->getMessage())->persistent();
            return redirect()->back()->with('error', 'Error uploading files: ' . $e->getMessage());
        }
    }


    public function place_bid(Request $request)
    {
        // Find the available order by ID
        $order = Order::findOrFail($request->id);
        $bidder = auth()->user();

        // Check if the user has already applied for this order
        $existingBid = Bid::where('OrderId', $order->id)
            ->where('writer_id', $bidder->id)
            ->first();

        // If the user has already applied for the order, return an error message
        if ($existingBid) {
            return redirect()->back()->with('error', 'You have already applied for this order');
        }

        // Create a new bid instance
        $bid = new Bid();

        // Retrieve the current user


        // Retrieve files associated with the order
        $files = Files::where('assignmentId', $order->id)->pluck('files')->toArray();

        // Populate bid properties
        $bid->OrderId=$order->id;
        $bid->assignmentType = $order->assignmentType;
        $bid->typeOfService = $order->typeOfService;
        $bid->topicTitle = $order->topicTitle;
        $bid->discipline = $order->discipline;
        $bid->pages = $order->pages;
        $bid->deadline = $order->deadline;
        $bid->cpp = $order->cpp;
        $bid->price =$order->price;
        $bid->comments = $order->comments;
        $bid->writer_id = $bidder->id;
        $bid->writer_name = $bidder->name;
        $bid->writer_phone = $bidder->phone;
        // Check if there are files associated with the order
        if (count($files) > 0) {
            // If there are files, set them in the bid
            $bid->files = $files;
        } else {
            // If no files, set a default value (e.g., "No files")
            $bid->files = "No files";
        }
        $bid->ucompleted_orders=0;

        // Save the bid
        $bid->save();

        Toastr::success('bid placed successfully', 'success');

        // Redirect to a specific page after a successful bid
        return redirect()->back()->with('success', 'Bid applied successfully');
    }



    public function available(Request $request)
    {
        try {
            DB::beginTransaction();

            $available = new Available();
            $order = Order::findOrFail($request->id);
            $bidder = auth()->user();
            $files = Files::where('assignmentId', $order->id)->pluck('files')->toArray();

            $available->OrderId=$order->id;
            $available->assignmentType = $order->assignmentType;
            $available->typeOfService = $order->typeOfService;
            $available->topicTitle = $order->topicTitle;
            $available->discipline = $order->discipline;
            $available->pages = $order->pages;
            $available->deadline = $order->deadline;
            $available->cpp = $order->cpp;
            $available->price = $order->price;
            $available->comments = $order->comment;
            $available->writer_id = 'N/A';
            $available->writer_name = 'N/A';
            $available->writer_phone = 'N/A';

            if (count($files) > 0) {
                // If there are files, set them in the bid
                $available->files = $files;
            } else {
                // If no files, set a default value (e.g., "No files")
                $available->files = "No files";
            }

            // Save the available record
            $available->save();

            //dd($available);

            // Delete the order record
          // $order->delete();
            $order->status='hidden';
            $order->update();

            DB::commit();

            return redirect()->back()->with('success', 'Order successfully placed in available');
        } catch (\Exception $e) {
            DB::rollBack();

            // Log or handle the exception as needed
            dd($e->getMessage());

            return redirect()->back()->with('error', 'Failed to process the order');
        }
    }

    public function remove_bid(Request $request)
    {
        // Find the bid by ID
        $bid = Bid::find($request->id);

        if (!$bid) {
            Alert::error('Error!', 'bid id is not found. Contact admin');
            return redirect()->back();
        }

        $bid->delete();

        Toastr::success('bid removed successfully', 'success');

        return redirect()->back()->with('success', 'bid removed successfully');

    }

    public function Messages(Request $request)
    {
        try {

            // Capture sender information
            $senderId = Auth::id();
            $senderName = Auth::user()->name;
            $senderUserType = Auth::user()->usertype;
            $senderPhone = Auth::user()->phone;
            $senderEmail= Auth::user()->email;

            // Get recipient, order ID, and message from the request
            $recipient = $request->input('recipient');
            $orderId = $request->input('orderId');
            $messageContent = $request->input('message');

            // Get recipient, order ID, and message from the request
            $recipient = $request->recipient;
            $orderId = $request->input('orderId');
            $messageContent = $request->input('message');

            // Create a new Message instance
            $message = new Message([
                'from' => $senderName,
                'from_phone' => $senderPhone,
                'from_email' => $senderEmail,
                'to' => $recipient,
                'to_email' => 'N/A',
                'to_phone' => 'N/A',
                'title' => 'New Message',
                'date' => now(),
                'message' => $messageContent,
            ]);

            // Save the message
            $message->save();

            // Optionally, you can return a response or redirect as needed
            // return response()->json($message);

            return redirect()->back()->with('success', 'message inserted successfully');
        }catch (\Exception $e) {

            Alert::success('success', $e->getMessage());
            //dd($e->getMessage());

            return redirect()->back()->with('error', 'Failed to process the order');
        }



    }



}
