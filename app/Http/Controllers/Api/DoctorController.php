<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        $doctors = Doctor::with('specialistCode:id,title', 'user:id,avatar,email,phone')
            ->select('id','name','address','sip_number','id_ihs','nik','specialist_code_id','user_id')
            ->when($request->input('search'), function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'status' => 'OK',
            'success' => true,
            'message' => 'Daftar Dokter',
            'data' => $doctors
        ], 200);
    }
}
