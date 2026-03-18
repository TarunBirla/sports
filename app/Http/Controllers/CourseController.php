<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\Course;
use Illuminate\Support\Facades\Session;

class CourseController extends Controller
{
public function index()
{
    $courses = Course::where('vendor_id', Session::get('vendor_id'))->get();
    return view('vendor.course.index', compact('courses'));
}

// CREATE PAGE
public function create()
{
    return view('vendor.course.create');
}

// STORE
public function store(Request $req)
{
    Course::create([
        'title'=>$req->title,
        'price'=>$req->price,
        'description'=>$req->description,
        'vendor_id'=>Session::get('vendor_id')
    ]);

    return redirect('/vendor/course');
}

// EDIT
public function edit($id)
{
    $course = Course::find($id);
    return view('vendor.course.edit', compact('course'));
}

// UPDATE
public function update(Request $req, $id)
{
    Course::where('id',$id)->update([
        'title'=>$req->title,
        'price'=>$req->price,
        'description'=>$req->description
    ]);

    return redirect('/vendor/course');
}

// DELETE
public function delete($id)
{
    Course::find($id)->delete();
    return back();
}
}
