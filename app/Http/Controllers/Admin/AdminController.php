<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function admin()
    {
        return view('admin.home');
    }
    public function logout()
    {
        Auth::logout();
        $notification = array('messege' => 'You are logged out!', 'alert-type' => 'success');
        return redirect()->route('admin.login')->with($notification);
    }
    public function passwordchange()
    {
        return view('admin.profile.create_password');
    }
    public function passwordUpdate(Request $request)
    {
        $validated = $request->validate([
            'old_password' => 'required',
            'password' => 'required'
        ]);
        $current_password = Auth::user()->password;

        $oldpass = $request->old_password;
        $new_password = $request->password;
        if (Hash::check($oldpass, $current_password)) {
            $user = User::findorfail(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            $notification = array('messege' => 'Your Password Changed!', 'alert-type' => 'success');
            return redirect()->route('admin.login')->with($notification);
        } else {
            $notification = array('messege' => 'Old Password Not Match!', 'alert-type' => 'error');
            return redirect()->route('admin.login')->with($notification);
        }
    }
}
