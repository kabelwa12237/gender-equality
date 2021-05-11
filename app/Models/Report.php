<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    //relationships
    public function users()
    {
        return $this->morphedByMany(User::class, 'reportabble');
    }

    /**
     * Get all of the videos that are assigned this tag.
     */
    public function organizations()
    {
        return $this->morphedByMany(Organization::class, 'reportabble');
    }
}
