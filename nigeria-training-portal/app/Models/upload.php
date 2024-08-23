<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class upload extends Model
{
    use HasFactory;

    protected $fillable = [
        // Add other fillable attributes here
        'title',
        'featured_image',
    ];
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(Business::class, 'user_id','user_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function participants(){
        return $this->hasMany(Paid_courses::class,'course_id');
    }
    public function sections(){
        return $this->hasMany(E_Course_Sections::class,'course_id');
    }
}
