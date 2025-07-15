<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function signin()
    {
        try {
            // return view
            return view('pages.sign-in');
        } catch (\Throwable $th) {
            /**
             * log error
             * abort 500
             */
            Log::error($th->getMessage());
            abort(500);
        }
    }

    // sign in
    public function signInProcess(Request $request)
    {
        try {
            // validate
            $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required', 'min:8']
            ]);

            // if invalid credential then response 401
            if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return response(null, 401);
            }

            // geerate url base from the role
            if (Auth::user()->role == 1) {
                $url = 'admin/dashboard';
            } else {
                $url = 'staff/dashboard';
            }

            // response 200 with the url
            return response()->json(['url' => $url]);
        } catch (\Throwable $th) {
            /**
             * log error
             * response 500
             */
            Log::error($th->getMessage());
            return response(null, 500);
        }
    }

    // sign out
    public function signOut()
    {
        try {
            Auth::logout();
            return redirect()->route('sign-in');
        } catch (\Throwable $th) {
            /**
             * log error
             * response 500
             */
            Log::error($th->getMessage());
            return response(null, 500);
        }
    }
}
