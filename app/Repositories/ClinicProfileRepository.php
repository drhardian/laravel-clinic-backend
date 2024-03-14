<?php

namespace App\Repositories;

use App\Interfaces\ClinicProfileInterface;
use App\Models\ClinicProfile;

class ClinicProfileRepository implements ClinicProfileInterface
{
    public function getClinicLogo()
    {
        $clinicLogo = ClinicProfile::select('logo')->first();

        return $clinicLogo->logo ? 'profile_logo/'.$clinicLogo->logo : 'avatar/default.jpg';
    }
}
