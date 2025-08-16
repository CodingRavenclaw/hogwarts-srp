<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class House extends Model
{
    use hasFactory;

    protected $fillable = [
        'name',
        'short_name',
        'color',
    ];

    /**
     * Get the students that belong to the house.
     */
    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }
}
