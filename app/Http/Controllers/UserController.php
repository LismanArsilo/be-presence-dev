<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Role;
use App\Models\ServiceUnit;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
  public function index(): View
  {
    $users = User::orderBy('username', 'ASC')->get();

    $data = [
      'users' => $users,
      'type_menu' => 'user'
    ];

    return view('pages.dashboard.user.index', ['data' => (object) $data]);
  }

  public function viewCreateUser(): View
  {
    $roles = Role::all();
    $positions = Position::all();
    $seviceUnits = ServiceUnit::all();

    $data = [
      'roles' => $roles,
      'positions' => $positions,
      'serviceUnits' => $seviceUnits,
      'type_menu' => 'user',
    ];

    return view('pages.dashboard.user.create-user', ['data' => (object)$data]);
  }

  public function apiCreateUser(Request $request)
  {
    try {
      $validate = Validator::make($request->all(), [
        'username' => 'required|unique:users,username',
        'fullname' => 'required|unique:users,fullname',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|unique:users,phone',
        'password' => 'required|min:5',
        'role' => 'required',
        'position' => 'required',
        'unit' => 'required',
        'join_date' => 'required|date'
      ]);

      if ($validate->fails()) return response()->redirectToRoute('view.create.user')->withInput()->withErrors($validate);

      $validated = $validate->validated();

      $data = [
        'username' => ucwords(strtolower($validated['username'])),
        'fullname' => ucwords(strtolower($validated['fullname'])),
        'email' => strtolower($validated['email']),
        'phone' => $validated['phone'],
        'password' => Hash::make($validated['password']),
        'role_id' => $validated['role'],
        'position_id' => $validated['position'],
        'unit_id' => $validated['unit'],
        'join_date' => $validated['join_date']
      ];

      User::create($data);

      return response()->redirectToRoute('view.list.user')->with('success', 'Create User Successfully');
    } catch (\Throwable $th) {
      return back();
    }
  }

  public function viewUpdateUser($id): View
  {
    $user = User::find($id);
    $roles = Role::all();
    $position = Position::all();
    $seviceUnit = ServiceUnit::all();

    $data = [
      'user' => $user,
      'roles' => $roles,
      'positions' => $position,
      'serviceUnits' => $seviceUnit,
      'type_menu' => 'user',
    ];

    return view('pages.dashboard.user.update-user', ['data' => (object)$data]);
  }

  public function apiUpdateUser(Request $request, $id)
  {
    try {
      $validate = Validator::make($request->all(), [
        'username' => 'required|unique:users,username,' . $request->id,
        'fullname' => 'required|unique:users,fullname,' . $request->id,
        'email' => 'required|email|unique:users,email,' . $request->id,
        'phone' => 'required',
        'password' => 'nullable',
        'role' => 'required',
        'position' => 'required',
        'unit' => 'required',
        'join_date' => 'required|date'
      ]);

      if ($validate->fails()) return response()->redirectToRoute('view.update.user', ['id' => $id])->withInput()->withErrors($validate);

      $validated = $validate->validated();

      $data = [
        'username' => ucwords(strtolower($validated['username'])),
        'fullname' => ucwords(strtolower($validated['fullname'])),
        'email' => strtolower($validated['email']),
        'phone' => $validated['phone'],
        'role_id' => $validated['role'],
        'position_id' => $validated['position'],
        'unit_id' => $validated['unit'],
        'join_date' => $validated['join_date']
        // 'password' => Hash::make($validated['password']),
      ];

      if (!empty($validated['password'])) {
        $data['password'] = Hash::make($validated['password']);
      }

      User::where('id', $id)->update($data);

      return response()->redirectToRoute('view.list.user')->with('success', 'Update User Successfully');
    } catch (\Throwable $th) {
      Log::debug($th->getMessage());
      return back();
    }
  }
}
