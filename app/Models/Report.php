<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use HasFactory;
    use SoftDeletes;
    /**
     * variable
     */
       protected $fillable = [
           "name"
       ];
       protected $dates = ["deleted_at"];
   
   /**
    * relationships
    */

public function users(){
    return $this->morphedByMany(User::class,'reportable');
}

  public function organizations(){
    return $this->morphedByMany(Organization::class,'reportable');
}

   
   
   
    /**
     * functions or operation
     */
   
}
