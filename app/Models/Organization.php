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
       * variables
       */
    protected $fillable=['name','type','contact','latitude','longitude'];
    protected $dates=['deleted_at'];

    /**
     * relationship
     */
  
/**shows the relations btn userd snd report using intermeadite table 'rechable'*/

     public function reports (){
return $this->morphToMany(Report::class,'reportable');

     }
}
