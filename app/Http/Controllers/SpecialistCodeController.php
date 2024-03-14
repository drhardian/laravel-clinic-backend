<?php

namespace App\Http\Controllers;

use App\Models\SpecialistCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SpecialistCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $specialistcodes = DB::table('specialist_codes')
            ->when($request->input('search'), function ($query, $search) {
                return $query->where('title', 'like', '%' . $search . '%');
            })
            ->orderBy('id','desc')
            ->paginate(10);

        $type_menu = 'specialist_code';

        return view('pages.specialist_code.index', compact('type_menu','specialistcodes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type_menu = "specialist_code";

        return view('pages.specialist_code.create', compact('type_menu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'acronym' => 'required',
        ]);

        DB::beginTransaction();

        try {
            SpecialistCode::create($request->only(['title', 'acronym']));

            DB::commit();

            return redirect()->route('specialistcode.index')->with('success', 'Specialist code created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return redirect()->back()->withErrors('Failed to create specialist code')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SpecialistCode $specialistcode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SpecialistCode $specialistcode)
    {
        $type_menu = "specialist_code";

        return view('pages.specialist_code.edit', compact('type_menu','specialistcode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SpecialistCode $specialistcode)
    {
        $request->validate([
            'title' => 'required',
            'acronym' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $specialistcode->update($request->only('title', 'acronym'));

            DB::commit();

            return redirect()->route('specialistcode.index')->with('success', 'Specialist code updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return redirect()->back()->with('error','Failed to update specialist code')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SpecialistCode $specialistcode)
    {
        DB::beginTransaction();

        try {
            $specialistcode->delete();

            DB::commit();

            return redirect()->back()->with('success', 'Specialist code deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return redirect()->back()->withErrors('Failed to delete specialist code');
        }
    }
}
