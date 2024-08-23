<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'category',
        'rate_per_hour',
        'description',
        'user_id',
    ];
    protected $guarded = [];
    public function categories()
    {
        return $this->belongsTo(Category::class, 'category');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
