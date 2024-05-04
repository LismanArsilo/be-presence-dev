<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    public function createPermission(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'date' => 'required',
                'reason' => 'required',
                'img_proof' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            if ($validate->fails()) {
                return response()->json(['status' => false, 'message' => $validate->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $validated = $validate->validated();

            if ($request->file('img_proof')) {
                $extension = $request->file('img_proof')->getClientOriginalExtension();
                $originalName = $request->file('img_proof')->getClientOriginalName();
                $replace = str_replace(' ', '-', $originalName);
                $pathName = now()->timestamp . '-' . $replace;
                $request->file('img_proof')->storeAs('public/filePermission/', $pathName);
            } else {
                $pathName = null;
            }

            $data = [
                'user_id' => Auth::user()->id,
                'date' => $validated['date'],
                'reason' => $validated['reason'],
                'img_proof' => $pathName,
            ];

            $permission = Permission::create($data);

            return response()->json(['status' => true, 'message' => 'Create Permission Successfully', 'data' => $permission], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Server Error : ' . $th->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
