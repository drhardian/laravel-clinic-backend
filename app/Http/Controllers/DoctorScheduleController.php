<?php

namespace App\Http\Controllers;

use App\Interfaces\ClinicProfileInterface;
use App\Models\Doctor;
use App\Models\DoctorSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class DoctorScheduleController extends Controller
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
        $doctorSchedules = DoctorSchedule::with('doctor')
            ->when($request->input('doctor_id'), function ($query, $doctor_id) {
                return $query->where('doctor_id', $doctor_id);
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        $type_menu = 'doctorschedule';

        return view('pages.doctor_schedule.index', compact('type_menu', 'doctorSchedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $doctors = Doctor::select('id', 'name')->get();

        $type_menu = "doctorschedule";

        return view('pages.doctor_schedule.create', compact('type_menu', 'doctors'));
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
    public function show(DoctorSchedule $doctorschedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DoctorSchedule $doctorschedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DoctorSchedule $doctorschedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DoctorSchedule $doctorschedule)
    {
        //
    }
}
