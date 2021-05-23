<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory;
    use SoftDeletes;
    /**
     * variable
     */

    protected $fillable = ['name','description'];
    protected $dates = ["deleted_at"];

    /**
     * relationships
     */
    public function users(){
   return $this->belongsToMany(User::class,'role_user');
    }
    


    /**
     * operations
     */


}
