<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = [
            'user' => $user,
            'type_menu' => 'dashboard'
        ];
        return view('pages.dashboard.index', ['data' => (object) $data]);
    }
}
