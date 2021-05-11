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
  * variable
  */
    protected $fillable = [
        "name","type","contact","latitude","longitude","address"
    ];
    protected $dates = ["deleted_at"];

 /**
  * relationships
  */
  //get relatnshp f reprts to organization
public function reports(){
    return $this->morphToMany(Report::class,'reportable');
}



 /**
  * functions or operation
  */

}
