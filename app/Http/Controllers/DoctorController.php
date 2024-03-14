<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\SpecialistCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $doctors = Doctor::with('specialistCode', 'user')
            ->when($request->input('search'), function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        $type_menu = 'doctor';

        return view('pages.doctor.index', compact('type_menu', 'doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specialistCodes = SpecialistCode::select('id', 'title')->get();
        $users = User::select('id', 'name')->get();

        $type_menu = "doctor";

        return view('pages.doctor.create', compact('type_menu', 'specialistCodes', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'specialist_code_id' => 'required|exists:specialist_codes,id',
            'address' => 'required',
            'sip_number' => 'required',
            'user_id' => 'required|exists:users,id',
        ]);

        DB::beginTransaction();

        try {
            Doctor::create($request->only([
                'name',
                'specialist_code_id',
                'address',
                'sip_number',
                'user_id',
            ]));

            DB::commit();

            return redirect()->route('doctor.index')->with('success', 'Doctor created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return redirect()->back()->withErrors('Failed to create doctor')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        $specialistCodes = SpecialistCode::select('id', 'title')->get();
        $users = User::select('id', 'name')->get();

        $type_menu = "doctor";

        return view('pages.doctor.edit', compact('type_menu','doctor','specialistCodes','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
            'name' => 'required',
            'specialist_code_id' => 'required|exists:specialist_codes,id',
            'address' => 'required',
            'sip_number' => 'required',
            'user_id' => 'required|exists:users,id',
        ]);

        DB::beginTransaction();

        try {
            $doctor->update($request->only(
                'name',
                'specialist_code_id',
                'address',
                'sip_number',
                'user_id',
            ));

            DB::commit();

            return redirect()->route('doctor.index')->with('success', 'Doctor updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return redirect()->back()->with('error','Failed to update doctor')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        DB::beginTransaction();

        try {
            $doctor->delete();

            DB::commit();

            return redirect()->back()->with('success', 'Doctor deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return redirect()->back()->withErrors('Failed to delete doctor');
        }
    }
}
