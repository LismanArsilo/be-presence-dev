<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //login
    public function apiLogin(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validate->fails()) return response()->json(['status' => false, 'message' => $validate->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);

            $validated = $validate->validated();

            if (Auth::check()) {
                return response()->json(['status' => false, 'message' => 'Employee Is Already Logged In'], Response::HTTP_FORBIDDEN);
            }

            $user = User::where('email', $validated['email'])->first();

            // Check Employee
            if (!$user) return response()->json(['status' => false, 'message' => 'User not found'], Response::HTTP_UNAUTHORIZED);

            // Check Password
            if (!Hash::check($validated['password'], $user->password)) return response()->json(['status' => false, 'message' => 'Invalid Credentials'], Response::HTTP_UNAUTHORIZED);

            $expiresAt = now()->addHours(12); // 24 hours
            $token = $user->createToken('authToken', ['*'], $expiresAt)->plainTextToken;
            $data = [
                'user' => $user,
                'token' => $token,
            ];

            return response()->json(['status' => true, 'data' => $data], Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::debug(json_encode($th, JSON_PRETTY_PRINT));
            return response()->json(['status' => false, 'message' => 'Server Login Error : ' . $th->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function apiLogout(Request $request)
    {
        try {
            $request->user()->tokens()->delete();

            return response()->json(['status' => true, 'message' => 'Logout Successfully'], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Server Login Error : ' . $th->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function apiUpdateProfile(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'face_embedding' => 'required'
            ]);

            if ($validate->fails()) return response()->json(['status' => false, 'message' => $validate->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);

            $validated = $validate->validated();

            if ($request->file('image')) {
                $extension = $request->file('image')->getClientOriginalExtension();
                $originalName = $request->file('image')->getClientOriginalName();
                $replace = str_replace(' ', '-', $originalName);
                $pathName = now()->timestamp . '-' . $replace;
                $request->file('image')->storeAs('public/images/', $pathName);
            } else {
                $pathName = null;
            }

            $user = User::where('id', Auth::user()->id)->first();
            $user->image_url = $pathName;
            $user->face_embedding = $validated['face_embedding'];
            $user->save();

            $data = [
                'user' => $user,
            ];

            return response()->json(['status' => true, 'message' => 'Update Profile Successfully', 'data' => $data], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Server Login Error : ' . $th->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
