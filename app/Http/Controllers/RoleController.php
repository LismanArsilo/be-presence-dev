<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        $data = [
            'roles' => $roles,
            'type_menu' => 'role',
        ];

        return view('pages.dashboard.role.index', ['data' => (object)$data]);
    }

    public function viewCreateRole(): View
    {
        $data = [
            'type_menu' => 'role',
        ];

        return view('pages.dashboard.role.create-role', ['data' => (object)$data]);
    }

    public function apiCreateRole(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'name' => 'required|string|unique:roles,name|max:255',
            ]);

            if ($validate->fails()) {
                return response()->redirectToRoute('view.create.role')->withInput()->withErrors($validate);
            }

            $validated = $validate->validated();

            $data = [
                'name' => ucwords(strtolower($validated['name'])),
            ];

            Role::create($data);

            return response()->redirectToRoute('view.list.role')->with('success', 'Create Role Successfully');
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
            return back();
        }
    }

    public function viewUpdateRole(Request $request, $id): View
    {
        $role = Role::where('id', $id)->first();

        $data = [
            'role' => $role,
            'type_menu' => 'role',
        ];

        return view('pages.dashboard.role.update-role', ['data' => (object)$data]);
    }

    public function apiUpdateRole(Request $request, $id)
    {
        try {
            $validate = Validator::make($request->all(), [
                'name' => 'required|string|unique:roles,name,' . $id,
            ]);

            if ($validate->fails()) {
                return response()->redirectToRoute('view.update.role', ['id' => $id])->withInput()->withErrors($validate);
            }

            $validated = $validate->validated();

            $role = Role::findOrFail($id);
            $role->name = ucwords(strtolower($validated['name']));
            $role->save();

            return response()->redirectToRoute('view.list.role')->with('success', 'Update Role Successfully');
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
            return back();
        }
    }
}
