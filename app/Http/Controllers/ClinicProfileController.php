<?php

namespace App\Http\Controllers;

use App\Interfaces\ClinicProfileInterface;
use App\Models\ClinicProfile;
use App\Models\Doctor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\ValidationException;

class ClinicProfileController extends Controller
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
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'description' => 'required',
            'doctor_id' => 'required|exists:doctors,id',
            'file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        DB::beginTransaction();

        try {
            if(!empty($request->file('file'))) {
                $logoFile = $request->file('file');
                $logoName = $logoFile->hashName();

                /* save new profile image into storage */
                $request->file('file')->storeAs('profile_logo',$logoName,'public');
            } else {
                throw ValidationException::withMessages(['file' => 'Image cannot be null']);
            }

            ClinicProfile::create(array_merge(
                $request->except('_token', 'file'),
                [
                    'logo' => $logoName,
                    'unique_code' => Carbon::now()->format('ymdHis')
                ]
            ));

            DB::commit();

            return redirect()->route('clinicprofile.index')->with('success', 'Profil klinik berhasil dibuat');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return redirect()->back()->withErrors('Gagal ketika menambahkan profil klinik')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ClinicProfile $clinicprofile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClinicProfile $clinicprofile)
    {
        $doctors = Doctor::select('id', 'name')->get();

        $type_menu = "doctor";

        return view('pages.clinic_profile.edit', compact('type_menu','clinicprofile','doctors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClinicProfile $clinicprofile)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'description' => 'required',
            'doctor_id' => 'required|exists:doctors,id',
            'file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        DB::beginTransaction();

        try {
            if(!empty($request->file('file'))) {
                $logoFile = $request->file('file');
                $logoName = $logoFile->hashName();

                /* save new profile image into storage */
                $request->file('file')->storeAs('profile_logo',$logoName,'public');

                $updateLogo = [ 'logo' => $logoName ];
            } else {
                $updateLogo = "";
            }

            $clinicprofile->update(array_merge(
                $request->except('_token', 'file'),
                $updateLogo
            ));

            DB::commit();

            return redirect()->route('clinicprofile.index')->with('success', 'Profil klinik berhasil dirubah');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return redirect()->back()->withErrors('Gagal ketika merubah profil klinik')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClinicProfile $clinicprofile)
    {
        DB::beginTransaction();

        try {
            $clinicprofile->delete();

            DB::commit();

            return redirect()->route('clinicprofile.index')->with('success', 'Profil klinik berhasil di hapus');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return redirect()->back()->withErrors('Gagal ketika menghapus profil klinik')->withInput();
        }
    }
}
