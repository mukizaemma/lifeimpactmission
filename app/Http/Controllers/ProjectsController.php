<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\StoresOptimizedImages;
use App\Models\Program;
use App\Models\Activity;
use App\Models\Projectimage;
use App\Services\ImageUploadService;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;

class ProjectsController extends Controller
{
    use StoresOptimizedImages;

    public function index()
    {

        $data = Activity::oldest()->get();
        $programs = Program::all();
        return view('admin.activities', ['data'=>$data,'programs'=>$programs]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => app(ImageUploadService::class)->validationRules(true, false),
        ]);

        $slug = Str::of($request->input('title'))->slug();

        $activity = new Activity();
        $activity->title = $request->input('title');
        $activity->description = $request->input('description');
        $activity->program_id = $request->input('program_id');
        $activity->slug = $slug;

        try {
            if ($request->hasFile('image')) {
                $activity->image = $this->storeOptimizedImage($request->file('image'), 'images/projects');
            }
        } catch (InvalidArgumentException $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
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
        $request->validate([
            'image' => app(ImageUploadService::class)->validationRules(true, false),
        ]);

        $data = Activity::find($id);
        // $data->branch_id = $request->input('branch_id');
        $data->title = $request->input('title');
        $data->description = $request->input('description');
        $data->program_id = $request->input('program_id');
        $data->created_at = $request->input('created_at');

        if(!$data){
            return back()->with('Error','Program Not Found');
        }

        try {
            if ($request->hasFile('image')) {
                $data->image = $this->storeOptimizedImage(
                    $request->file('image'),
                    'images/projects',
                    true,
                    $data->image
                );
            }
        } catch (InvalidArgumentException $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
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
                'image.*' => app(ImageUploadService::class)->validationRules(true, true),
                'activity_id' => 'required|exists:activities,id',
            ]);

            try {
                if ($request->hasFile('image')) {
                    foreach ($request->file('image') as $image) {
                        $fileName = $this->storeOptimizedImage($image, 'images/projects');

                        Projectimage::create([
                            'image'             => $fileName,
                            'activity_id' => $request->activity_id,
                            'added_by' => $request->user()->id
                        ]);
                    }

                    return redirect()->back()->with('success', 'Images uploaded successfully!');
                }
            } catch (InvalidArgumentException $e) {
                return redirect()->back()->withInput()->with('error', $e->getMessage());
            }

            return redirect()->back()->with('error', 'No images were uploaded.');
        }

    public function deleteProjectImage($id){
        $image = Projectimage::findOrFail($id);

        $imagePath = 'images/projects/' . ltrim($image->image, '/');

        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

        $image->delete();

        return redirect()->back()->with('warning', 'Image has been deleted');
    }

}
