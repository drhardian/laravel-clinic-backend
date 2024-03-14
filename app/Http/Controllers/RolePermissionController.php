<?php

namespace App\Http\Controllers;

use App\Models\RolePermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolePermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rolepermissions = DB::table('role_permissions')
            ->join('permissions', 'role_permissions.permission_id', '=', 'permissions.id')
            ->when($request->input('search'), function ($query, $search) {
                return $query->where('role_permissions.role', 'like', '%' . $search . '%')->orWhere('permissions.title', 'like', '%' . $search . '%');
            })
            ->orderBy('role_permissions.id','desc')
            ->paginate(10);

        $type_menu = 'rolepermission';

        return view('pages.role_permission.index', compact('type_menu','rolepermissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type_menu = "rolepermission";

        return view('pages.role_permission.create', compact('type_menu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(RolePermission $rolepermission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RolePermission $rolepermission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RolePermission $rolepermission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RolePermission $rolepermission)
    {
        //
    }
}
