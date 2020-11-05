<?php

namespace App\Models\Descri;

use Illuminate\Database\Eloquent\Model;

class descri extends Model
{
    protected $table = 'descris';

    protected $fillable = [
        'course_id','desc_en','desc_ar','pre_en','pre_ar'
    ];
}
