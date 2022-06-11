<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'dept_name',
        'faculty_id'
    ];
    public function faculy(){
       return $this->belongsTo(Faculty::class);
    }
    public function users(){
        return $this->hasMany(User::class);
     }
     public function courses(){
        return $this->belongsToMany(Course::class);
     }
     public function posts(){
        return $this->hasMany(Post::class);
    }
}
