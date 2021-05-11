<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

     /**
     * Get all of the organizations that are assigned this report.
     */
    public function organizations()
    {
        return $this->morphedByMany(Organization::class, 'reportable');
    }

    /**
     * Get all of the users that are assigned this report.
     */
    public function users()
    {
        return $this->morphedByMany(User::class, 'reportable');
    }
}
