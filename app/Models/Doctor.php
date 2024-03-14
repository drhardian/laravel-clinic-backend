<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'specialist_code_id',
        'address',
        'sip_number',
        'user_id',
        'id_ihs',
        'nik'
    ];

    /**
     * Get the specialistCode that owns the Doctor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function specialistCode(): BelongsTo
    {
        return $this->belongsTo(SpecialistCode::class);
    }

    /**
     * Get the user that owns the Doctor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
