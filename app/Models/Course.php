<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable=[
        'course_name'
    ];

    public function users(){//many to many between course & user
        return $this->belongsToMany(User::class)->withPivot('grade');;
    }
    public function departments(){//many to many between course & department
        return $this->belongsToMany(Department::class);
    }
    public function lectures(){
        return $this->hasMany(Lecture::class);
     }

}
