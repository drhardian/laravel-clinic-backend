<?php

namespace App\Http\Controllers;

use App\Interfaces\ClinicProfileInterface;
use App\Models\Doctor;
use App\Models\DoctorSchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class DoctorScheduleController extends Controller
{
    private ClinicProfileInterface $clinicProfileRepository;
    private $pageTitle;

    public function __construct(ClinicProfileInterface $clinicProfileRepository)
    {
        $this->pageTitle = 'Jadwal Dokter';
        $this->clinicProfileRepository = $clinicProfileRepository;
        View::share('clinicLogo', $this->clinicProfileRepository->getClinicLogo());
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $doctorSchedules = DB::table('doctor_schedules')
            ->select(
                'doctor_schedules.id as id',
                'doctor_schedules.doctor_id as doctor_id',
                'doctor_schedules.day as day',
                'doctor_schedules.time as time',
                'doctor_schedules.notes as notes',
                'doctors.name as name',
                'specialist_codes.title as specialist',
            )
            ->join('doctors', 'doctor_schedules.doctor_id', '=', 'doctors.id')
            ->join('specialist_codes', 'doctors.specialist_code_id', '=', 'specialist_codes.id')
            ->when($request->input('search'), function($query, $search) {
                $query->where('doctors.name', 'like', '%'.$search.'%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        $type_menu = 'doctorschedule';
        $pageTitle = $this->pageTitle;

        return view('pages.doctor_schedule.index', compact('type_menu','pageTitle','doctorSchedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $doctors = Doctor::select('id', 'name')->get();
        $days = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];

        $type_menu = "doctorschedule";
        $pageTitle = $this->pageTitle;

        return view('pages.doctor_schedule.create', compact('type_menu','pageTitle','doctors','days'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required',
        ]);

        DB::beginTransaction();

        try {
            foreach ($request->day as $key => $value) {
                DoctorSchedule::updateOrCreate([
                    'doctor_id' => $request->doctor_id,
                    'day' => $value
                ],[
                    'time' => !empty($request->status[$key]) ? $request->jam_awal[$key].' - '.$request->jam_akhir[$key] : null,
                    'notes' => !empty($request->notes[$key]) ? strip_tags($request->notes[$key]) : null,
                    'status' => empty($request->status[$key]) ? 'Tidak Aktif' : 'Aktif'
                ]);
            }

            DB::commit();

            return redirect()->route('scheduledoctor.index')->with('success', 'Jadwal dokter berhasil dibuat');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return redirect()->back()->withErrors('Gagal ketika menambahkan jadwal dokter')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DoctorSchedule $scheduledoctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DoctorSchedule $scheduledoctor)
    {
        $doctors = Doctor::select('id', 'name')->get();
        $days = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];

        $type_menu = "doctorschedule";
        $pageTitle = $this->pageTitle;

        $initialTime = explode(" - ",$scheduledoctor->time);

        $jam_awal = Carbon::parse($initialTime[0])->format('H:i A');
        $jam_akhir = Carbon::parse($initialTime[1])->format('H:i A');

        return view('pages.doctor_schedule.edit', compact('type_menu','pageTitle','doctors','days','scheduledoctor','jam_awal','jam_akhir'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DoctorSchedule $scheduledoctor)
    {
        $request->validate([
            'doctor_id' => 'required',
            'day' => 'required',
            'jam_awal' => 'required',
            'jam_akhir' => 'required',
            'status' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $scheduledoctor->update(
                array_merge(
                    $request->only('doctor_id','day','status'),
                    [
                        'time' => $request->jam_awal.' - '.$request->jam_akhir,
                        'notes' => strip_tags($request->notes)
                    ]
                )
            );

            DB::commit();

            return redirect()->route('scheduledoctor.index')->with('success', 'Jadwal dokter berhasil dirubah');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return redirect()->back()->withErrors('Gagal ketika merubah jadwal dokter')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DoctorSchedule $scheduledoctor)
    {
        DB::beginTransaction();

        try {
            $scheduledoctor->delete();

            DB::commit();

            return redirect()->back()->with('success', 'Jadwal dokter berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return redirect()->back()->withErrors('Gagal ketika menghapus jadwal dokter');
        }
    }

    public function getSchedule(Request $request)
    {
        $schedules = DoctorSchedule::select('day','time','notes','status')->where('doctor_id',$request->doctor_id)->get();

        return response()->json([
            'success' => true,
            'data' => [
                'total' => $schedules->count(),
                'schedules' => $schedules
            ]
        ],200);
    }
}
