<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $permissions = Permission::with(['user'])->when($request->input('username'), function ($query, $username) {
            $query->whereHas('user', function ($query) use ($username) {
                $query->where('username', 'like', '%' . $username . '%');
            });
        })->orderBy('date', 'DESC')->paginate(10);
        $data = [
            'permissions' => $permissions,
            'type_menu' => 'permission'
        ];
        return view('pages.dashboard.permission.index', ['data' => (object)$data]);
    }
}
