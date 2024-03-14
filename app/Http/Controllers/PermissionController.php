<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $permissions = DB::table('permissions')
            ->when($request->input('search'), function ($query, $search) {
                return $query->where('title', 'like', '%' . $search . '%');
            })
            ->orderBy('id','desc')
            ->paginate(10);

        $type_menu = 'permission';

        return view('pages.permission.index', compact('type_menu','permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type_menu = "permission";

        return view('pages.permission.create', compact('type_menu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        DB::beginTransaction();

        try {
            Permission::create($request->only(['title','description']));

            DB::commit();

            return redirect()->route('permission.index')->with('success', 'Permission created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return redirect()->back()->withErrors('Failed to create specialist code')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        $type_menu = "permission";

        return view('pages.permission.edit', compact('type_menu','permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $permission->update($request->only('title', 'description'));

            DB::commit();

            return redirect()->route('permission.index')->with('success', 'Permission updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return redirect()->back()->with('error','Failed to update Permission')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        DB::beginTransaction();

        try {
            $permission->delete();

            DB::commit();

            return redirect()->back()->with('success', 'Permission deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return redirect()->back()->withErrors('Failed to delete Permission');
        }
    }
}
