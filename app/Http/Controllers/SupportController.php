<?php

namespace App\Http\Controllers;

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

}
