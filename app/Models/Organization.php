<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Variables
     */
    protected $fillable = ['name', 'type', 'contact', 'address', 'latitude', 'longitude'];

    protected $dates = ['deleted_at'];

    /**
     * Relationship presented by function
     */

     /**Get all reports for the Organization */

     public function Reports(){
        return $this->morphedToMany(Report::class, 'reportable');
     }
}
