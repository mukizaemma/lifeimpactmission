<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Activity;
use App\Models\Projectimage;
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
    
        $slug = Str::of($request->input('title'))->slug();

        $activity = new Activity();
        $activity->title = $request->input('title');
        $activity->description = $request->input('description');
        $activity->program_id = $request->input('program_id');
        $activity->slug = $slug;
    
        if ($request->hasFile('image')) {
            $dir = 'public/images/projects';
            $path = $request->file('image')->store($dir);
            $fileName = str_replace($dir . '/', '', $path);
            $activity->image = $fileName;
        }

        $saved = $activity->save();
        
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
        $images = $data->images;
        $totalImages = $images->count();
        $programs = Program::all();
        return view('admin.activityUpdate', ['data'=>$data,'programs'=>$programs, 'images'=>$images,'totalImages'=>$totalImages]);
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

    
    public function addProjectImage(Request $request)
        {
            $request->validate([
                'image.*'           => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate each image
                'activity_id' => 'required|exists:activities,id', // Ensure the wedding gallery exists
            ]);

            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $image) {
                    $dir = 'public/images/projects';
                    $path = $image->store($dir);
                    $fileName = str_replace($dir . '/', '', $path);

                    Projectimage::create([
                        'image'             => $fileName,
                        'activity_id' => $request->activity_id, 
                        'added_by' => $request->user()->id
                    ]);
                }

                return redirect()->back()->with('success', 'Images uploaded successfully!');
            }

            return redirect()->back()->with('error', 'No images were uploaded.');
        }

    public function deleteProjectImage($id){
        $image = Projectimage::findOrFail($id);

        $imagePath = 'public/images/projects/' . $image->filename;

        if (Storage::exists($imagePath)) {
            Storage::delete($imagePath);
        }

        $image->delete();

        return redirect()->back()->with('warning', 'Image has been deleted');
    }

}
