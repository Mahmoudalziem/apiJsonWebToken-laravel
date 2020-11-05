<?php

namespace App\Http\Controllers\Courses;

use App\Http\Controllers\Controller;
use App\Http\Traits\response;
use App\Models\Courses\courses;
use Illuminate\Http\Request;

class coursesController extends Controller
{
    public function course($id){
        
        if(courses::where('title', str_replace('_', ' ', $id))->count()){

            $course = courses::where('title', str_replace('_', ' ', $id));

            $courseContent = $course->first();

            // return $courseContent->id;

            $comments = courses::find($courseContent->id)->comments;

            $this->data = [
                    'course' => $courseContent,
                    'descri' => courses::find($courseContent->id)->descri,
                    'comments' => $comments
                ];

            $this->status = true;

            $this->message = 'Success return course';

        }else{

            $this->status = false;

            $this->message = 'Course not found';

            $this->data = [
                'message' => 'This Course Not Found'
            ];
        }

        return response::returnData($this->status,$this->message,$this->data);
    }
}
