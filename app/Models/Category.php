<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public function tutors()
    {
        return $this->hasMany(Tutor::class, 'category');
    }
    
}
