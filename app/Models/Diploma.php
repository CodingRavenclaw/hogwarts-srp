<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Diploma extends Model
{
    use hasFactory;

    protected $fillable = [
        'name',
        'short_name',
    ];

    /**
     * Get the students that have the diploma.
     */
    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }
}
