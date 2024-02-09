<?php

namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
            $order->files='N/A';
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
            return redirect()->route('new_files');

        } catch (Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    public function files(Request $request)
    {
        $files= new Files();
        $order=Order::where('id', $request->id);
        $user=auth()->user();

        $files->assignmentId=$order->id;
        $files->employee_id=$user->id;
        $files->employee_name=$user->name;
        $files->employee_phone=$user->phone;

        $image = $request->file('files');
        $imageContents = file_get_contents($image->path());
        $base64Image = base64_encode($imageContents);
            // Generate a unique identifier for the filename
        $uniqueFilename = uniqid() . '.' . $image->getClientOriginalExtension();

        file_put_contents(public_path('assignment') . '/' . $uniqueFilename, base64_decode($base64Image));

        $files->files = $uniqueFilename;

        return response()->json($files);
       // $files->save();

        return  redirect()->back()->with('success', 'files uploaded successfully');

    }

}
