<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function viewLogin()
    {
        return view('pages.auth.auth-login');
    }

    // public function apiLogin(Request $request)
    // {
    //     try {
    //         $validate = Validator::make($request->all(), [
    //             'email' => 'required|email',
    //             'password' => 'required|min:2',
    //         ]);

    //         if ($validate->fails()) return back()->withErrors($validate->errors());

    //         $validated = $validate->validated();

    //         $credentials = [
    //             'email' => $validated['email'],
    //             'password' => $validated['password'],
    //         ];
    //         if (Auth::attempt($credentials)) {
    //             $request->session()->regenerate();
    //             return response()->redirectToRoute('dashboard')->with('success', 'Anda berhasil login!');
    //         } else {
    //             return back()->withErrors([
    //                 'email' => 'The provided credentials do not match our records.',
    //             ])->onlyInput('email');
    //         }
    //     } catch (\Throwable $th) {
    //         return back();
    //     }
    // }


    // public function apiLogout(Request $request)
    // {
    //     try {
    //         Auth::logout();

    //         $request->session()->invalidate();

    //         $request->session()->regenerateToken();

    //         return response()->json(['status' => true, 'message' => 'Logout Successfully'], Response::HTTP_OK);
    //     } catch (\Throwable $th) {
    //         return response()->json(['status' => false, 'message' => 'Logout Error'], Response::HTTP_INTERNAL_SERVER_ERROR);
    //     }
    // }
}
