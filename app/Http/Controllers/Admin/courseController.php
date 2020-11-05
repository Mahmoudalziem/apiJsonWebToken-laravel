<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\response;
use App\Models\Courses\courses;
use App\Models\Descri\descri;
use Illuminate\Http\Request;

class courseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        if($request->method('GET') && $request->has('title')){

            if(courses::where('title',request('title'))->count()){

                if(app()->getLocale() === 'ar'){

                    $course = courses::where('title',request('title'))->first();

                    $course = $course->id;

                    descri::where('course_id',$course)->update([
                        'desc_ar' => request('desc_ar'),
                        'pre_ar' => request('pre_ar')
                    ]);

                    $this->status = false;

                    $this->message = 'Add Arabic Course';

                    $this->data = ['message' => 'Success Adding Arabic Course'];

                }else{

                    $this->status = false;

                    $this->message = 'Failed Add Course';

                    $this->data = ['message' => 'This Course Already Found'];
                }
            } else {
                courses::create([
                    'title' => request('title'),
                    'subtitle' => request('subtitle'),
                    'img' => request('img'),
                    'intro_video' => request('intro_video'),
                    'hours' => request('hours')
                ]);

                descri::create([
                    'course_id' => courses::where('title', request('title'))->first()->id,
                    'desc_en' => request('desc_en'),
                    'pre_en' => request('pre_en')
                ]);

                $this->status = true;

                $this->message = 'Success Adding Course';

                $this->data = [
                    'message' => 'success Adding'
                ];
            }

            return response::returnData($this->status, $this->message, $this->data);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
