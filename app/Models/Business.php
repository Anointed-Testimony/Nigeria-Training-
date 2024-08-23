<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [
        'user_id',
        'businessname',
        'website',
        'business_type',
        'specialization',
        'contact_person',
        'description',
        'featured'
    ];

    public function posts()
    {
        return $this->hasMany(upload::class, 'user_id');
    }    
    
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
