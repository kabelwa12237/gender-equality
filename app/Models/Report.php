<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;


    /**
     * Relationship
     */
    public function users()
    {
        return $this->morphedByMany(User::class,'reportable');
    } //shows the relationship of user and report using intermediate table reportable
    //get all of the users that are assigned this report

    public function organizations()
    {
        return $this->morphToMany(Organization::class,'reportable');
    } //shows the relationship of organization and report using intermediate table reportables
    // get all of the organizations that are assigned this report




}
