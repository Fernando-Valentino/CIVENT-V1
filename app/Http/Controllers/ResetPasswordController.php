<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class ResetPasswordController extends Controller
{
    // Show the form to reset the password
    public function showResetForm()
    {
        return view('auth.passwords.reset');
    }

    // Reset the password
    public function reset(Request $request)
    {
        $request->validate([
            'identifier' => 'required', // NIM or Email
            'password' => 'required|min:4|confirmed',
        ]);

        $user = User::where('email', $request->identifier)
            ->orWhere('nim', $request->identifier)
            ->first();

        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('login')->with('success', 'Password has been reset successfully');
        } else {
            return back()->with('error', 'No user found with this NIM or Email.');
        }
    }
}
