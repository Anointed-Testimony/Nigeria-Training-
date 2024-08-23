<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class E_Course_Sections extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function videos(){
        return $this->hasMany(CourseVideos::class,'section_id','section_id');
    }
}
