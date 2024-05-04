<?php

namespace App\Http\Controllers;

use App\Models\ServiceUnit;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ServiceUnitController extends Controller
{
    public function index(): View
    {
        $serviceUnits = ServiceUnit::orderBy('created_at', 'desc')->get();

        $data = [
            'serviceUnits' => $serviceUnits,
            'type_menu' => 'service-unit',
        ];
        return view('pages.dashboard.service-unit.index', ['data' => (object)$data]);
    }

    public function viewCreateServiceUnit(): View
    {
        $data = [
            'type_menu' => 'service-unit',
        ];

        return view('pages.dashboard.service-unit.create-service-unit', ['data' => (object)$data]);
    }

    public function apiCreateServiceUnit(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'name' => 'required|unique:service_units,name'
            ]);

            if ($validate->fails()) return response()->redirectTo('view.create.service-unit')->withInput()->withErrors($validate);

            $validated = $validate->validated();

            $data = [
                'name' => ucwords(strtolower($validated['name'])),
            ];

            ServiceUnit::create($data);

            return response()->redirectToRoute('view.list.service-unit')->with('success', 'Create Service Unit Successfuly');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return back();
        }
    }

    public function viewUpdateServiceUnit($id): View
    {
        $serviceUnit = ServiceUnit::findOrFail($id);

        $data = [
            'serviceUnit' => $serviceUnit,
            'type_menu' => 'service-unit',
        ];

        return view('pages.dashboard.service-unit.update-service-unit', ['data' => (object)$data]);
    }

    public function apiUpdateServiceUnit(Request $request, $id)
    {
        try {
            $validate = Validator::make($request->all(), [
                'name' => 'required|unique:service_units,name,' . $id
            ]);

            if ($validate->fails()) return response()->redirectTo('view.update.service-unit')->withInput()->withErrors($validate);

            $validated = $validate->validated();

            $serviceUnit = ServiceUnit::findOrFail($id);
            $serviceUnit->name = ucwords(strtolower($validated['name']));
            $serviceUnit->save();

            return response()->redirectToRoute('view.list.service-unit')->with('success', 'Update Service Unit Successfuly');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return back();
        }
    }
}
