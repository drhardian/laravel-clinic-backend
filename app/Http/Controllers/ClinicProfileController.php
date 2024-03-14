<?php

namespace App\Http\Controllers;

use App\Models\ClinicProfile;
use App\Models\Doctor;
use Illuminate\Http\Request;

class ClinicProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $clinicprofiles = ClinicProfile::with('doctor')
            ->when($request->input('search'), function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        $type_menu = 'clinicprofile';

        return view('pages.clinic_profile.index', compact('type_menu','clinicprofiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $doctors = Doctor::select('id', 'name')->get();

        $type_menu = "clinicprofile";

        return view('pages.clinic_profile.create', compact('type_menu', 'doctors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ClinicProfile $clinicProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClinicProfile $clinicProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClinicProfile $clinicProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClinicProfile $clinicProfile)
    {
        //
    }
}
