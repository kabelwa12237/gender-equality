<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    // variables
    use HasFactory;
    use SoftDeletes;
    protected $fillables=['name','type','contact','latitude','longitude','address'];
    protected $dates=["deleted at"];

    //Relationships 
    public function report (){
        return $this->morphToMany(Report::class, 'reportabble');
    }

}

