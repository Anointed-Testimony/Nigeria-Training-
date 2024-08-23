<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participants extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function host(){
        return $this->hasOne(upload::class, 'id', 'course_id');
    }
}
