<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use hasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'birthday',
        'house_id',
        'blood_status_id',
        'enrollment_date',
        'graduation_date',
        'diploma_id',
    ];

    protected $dates = [
        'birthday',
        'enrollment_date',
        'graduation_date',
    ];

    /**
     * Get the house that the student belongs to.
     */
    public function house(): BelongsTo
    {
        return $this->belongsTo(House::class);
    }

    /**
     * Get the blood status that the student belongs to.
     */
    public function bloodStatus(): BelongsTo
    {
        return $this->belongsTo(BloodStatus::class);
    }

    /**
     * Get the diploma that the student has.
     */
    public function diploma(): BelongsTo
    {
        return $this->belongsTo(Diploma::class);
    }

    /**
     * Get the full name of the student.
     */
    public function getFullNameAttribute(): string
    {
        return $this->first_name.' '.$this->last_name;
    }
}
