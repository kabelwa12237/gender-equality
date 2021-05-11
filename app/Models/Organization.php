<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Organization extends Model
{
    /**
     * variables
     * 
     */
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name','type','contact','latitude','longitude','contact'];//this
    protected $dates = ['deleted_at'];

    /**
     * Relationship
     * writing relationship of the organization
     */
    public function reports()
    {
        return $this->morphToMany(Report::class,'reportable');
    } //shows the relationship of organization and report using intermediate table reportables


     /**
      * operations
      */
}
