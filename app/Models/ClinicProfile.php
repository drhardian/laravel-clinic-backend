<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicProfile extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'logo',
        'description',
        'doctor_id',
        'unique_code'
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
