<?php

namespace App\Http\Controllers;

use App\Interfaces\ClinicProfileInterface;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PatientController extends Controller
{
    private ClinicProfileInterface $clinicProfileRepository;

    public function __construct(ClinicProfileInterface $clinicProfileRepository)
    {
        $this->clinicProfileRepository = $clinicProfileRepository;
        View::share('clinicLogo', $this->clinicProfileRepository->getClinicLogo());
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $patients = Patient::when($request->input('search'), function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        $type_menu = 'patient';

        return view('pages.patient.index', compact('type_menu', 'patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        //
    }
}
