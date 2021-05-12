<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    public function Organization()
    {
        return $this->morphedByMany(Organization::class, 'reportable');
    }

    public function User()
    {
        return $this->morphedByMany(User::class, 'reportable');
    }


}
