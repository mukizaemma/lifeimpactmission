<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Activity;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProjectsController extends Controller
{
    
    public function index()
    {

        $data = Activity::latest()->get();
        $programs = Program::all();
        return view('admin.activities', ['data'=>$data,'programs'=>$programs]);
    }

    public function store(Request $request)
    {
        $rules = [
        'title' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    
        $validate = Validator::make($request->all(), $rules);
        
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput();
        } 
    
        $fileName = '';
        if($request->hasFile('image')){
            $file = $request->file('image');
            $path = $file->store('public/images/projects');
            $fileName = basename($path);
        }
    
        $slug = Str::of($request->input('title'))->slug();
    
        $category = new Activity();
        $category->title = $request->input('title');
        $category->description = $request->input('description');
        $category->program_id = $request->input('program_id');
        $category->slug = $slug;
        $category->image = $fileName;
        $saved = $category->save();
        
        if($saved){
            return redirect()->route('getProjects')->with('success', 'Program created successfully.');
        }
        else{
            return redirect()->back()->with('error', 'Something Went wrong.');
        }

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Activity::find($id);
        $programs = Program::all();
        return view('admin.activityUpdate', ['data'=>$data,'programs'=>$programs]);
    }


    public function update(Request $request, $id)
    {
        $data = Activity::find($id);
        // $data->branch_id = $request->input('branch_id');
        $data->title = $request->input('title');
        $data->description = $request->input('description');
        $data->program_id = $request->input('program_id');

        if(!$data){
            return back()->with('Error','Program Not Found');
        }

        if ($request->hasFile('image') && request('image') != '') {
            $dir = 'public/images/projects';

            if (File::exists($dir)) {
                unlink($dir);
            }
            $path = $request->file('image')->store($dir);
            $fileName = str_replace($dir, '', $path);

            $data->image = $fileName;
        }

        $data->update();

        return redirect()->route('getProjects')->with('success','Project has been updated');
    }

    public function destroy($id)
    {
        $data = Activity::find($id);
        $data->delete($id);
        return redirect()->back()->with('success', 'Item has been deleted');
    }
}
