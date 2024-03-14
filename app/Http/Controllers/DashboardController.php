<?php

namespace App\Http\Controllers;

use App\Interfaces\ClinicProfileInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    private ClinicProfileInterface $clinicProfileRepository;

    public function __construct(ClinicProfileInterface $clinicProfileRepository)
    {
        $this->clinicProfileRepository = $clinicProfileRepository;
        View::share('clinicLogo', $this->clinicProfileRepository->getClinicLogo());
    }

    public function index()
    {
        $type_menu = "dashboard";

        return view('dashboard-general-dashboard', compact('type_menu'));
    }
}
