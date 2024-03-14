<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialistCode extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'acronym',
    ];
}
