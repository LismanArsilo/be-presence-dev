<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function index(Request $request): View
    {
        $companies = Company::all();

        $data = [
            'companies' => $companies,
            'type_menu' => 'company'
        ];

        return view('pages.dashboard.company.index', ['data' => (object)$data]);
    }

    public function viewCreateCompany(): View
    {
        $data = [
            'type_menu' => 'company'
        ];

        return view('pages.dashboard.company.create-company', ['data' => (object)$data]);
    }

    public function apiCreateCompany(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:companies',
                'latitude' => 'required|string',
                'longitude' => 'required|string',
                'phone_number' => 'required|string',
                'website' => 'required|string',
                'time_in' => 'required',
                'time_out' => 'required',
                'radius' => 'required|numeric',
                'address' => 'required|string'
            ]);

            if ($validate->fails()) {
                return response()->redirectToRoute('view.create.company')->withInput()->withErrors($validate);
            }

            $validated = $validate->validated();

            $data = [
                'name' => strtoupper($validated['name']),
                'email' => strtolower($validated['email']),
                'latitude' => $validated['latitude'],
                'longitude' => $validated['longitude'],
                'phone_number' => $validated['phone_number'],
                'website' => $validated['website'],
                'time_in' => $validated['time_in'],
                'time_out' => $validated['time_out'],
                'radius_km' => $validated['radius'],
                'address' => $validated['address']
            ];

            Company::create($data);

            return response()->redirectToRoute('view.list.company')->with('success', 'Create Company Successfully');
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
            return back();
        }
    }

    public function viewUpdateCompany(Request $request, $id)
    {
        $company = Company::where('id', $id)->first();

        $data = [
            'company' => $company,
            'type_menu' => 'company'
        ];

        return view('pages.dashboard.company.update-company', ['data' => (object)$data]);
    }

    public function apiUpdateCompany(Request $request, $id)
    {
        try {
            $validate = Validator::make($request->all(), [
                'name' => 'nullable|string|max:255',
                'email' => "nullable|string|email|max:255|unique:companies,email," . $id,
                'latitude' => 'nullable|string',
                'longitude' => 'nullable|string',
                'phone_number' => 'nullable|string',
                'website' => 'nullable|string',
                'time_in' => 'nullable',
                'time_out' => 'nullable',
                'radius' => 'nullable|numeric',
                'address' => 'nullable|string'
            ]);

            if ($validate->fails()) {
                return response()->redirectToRoute('view.update.company', ['id' => $id])->withInput()->withErrors($validate);
            }

            $validated = $validate->validated();

            $company = Company::where('id', $id)->first();
            $company->name = strtoupper($validated['name']);
            $company->email = strtolower($validated['email']);
            $company->latitude = $validated['latitude'];
            $company->longitude = $validated['longitude'];
            $company->phone_number = $validated['phone_number'];
            $company->website = $validated['website'];
            $company->time_in = $validated['time_in'];
            $company->time_out = $validated['time_out'];
            $company->radius_km = $validated['radius'];
            $company->address = $validated['address'];
            $company->save();

            return response()->redirectToRoute('view.list.company')->with('success', 'Update Company Successfully');
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
            return back();
        }
    }
}
