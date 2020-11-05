<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Model;

class courses extends Model
{

    protected $table = 'courses';

    protected $guarded = [];

    protected $fillable = [
        'title', 'subtitle','img','intro_video','hours'
    ];

    protected $hidden = ['is_published'];

    public function comments()
    {

        return $this->hasMany('\App\Models\Comments\comment','course_id');
    }

    /// Description
    public function descri(){

        return $this->hasOne('\App\Models\Descri\descri','course_id','id');
    }

}
