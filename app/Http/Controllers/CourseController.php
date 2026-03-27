<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
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
        $categories = Category::where('type', 'course')->get();
        return view('vendor.course.create', compact('categories'));
    }

    // STORE
    public function store(Request $req)
    {
        $req->validate([
            'title' => 'required',
            'price' => 'required',
            'category_id' => 'required'
        ]);

        $image = null;

        if ($req->hasFile('image')) {
            $image = time() . '.' . $req->image->extension();
            $req->image->move(public_path('courses'), $image);
        }

        Course::create([
            'title' => $req->title,
            'price' => $req->price,
            'description' => $req->description,
            'category_id' => $req->category_id,
            'image' => $image,
            'vendor_id' => Session::get('vendor_id')
        ]);

        return redirect('/vendor/course');
    }

    // EDIT
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $categories = Category::where('type', 'course')->get();

        return view('vendor.course.edit', compact('course', 'categories'));
    }

    // UPDATE
   public function update(Request $req, $id)
    {
        
        $req->validate([
            'title' => 'required',
            'price' => 'required',
            'category_id' => 'required'
        ]);

        $course = Course::findOrFail($id);

        $image = $course->image;

        if ($req->hasFile('image')) {
            $image = time().'.'.$req->image->extension();
            $req->image->move(public_path('courses'), $image);
        }

        $course->update([
            'title' => $req->title,
            'price' => $req->price,
            'description' => $req->description,
            'category_id' => $req->category_id,
            'image' => $image
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
