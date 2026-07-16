<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\StoresOptimizedImages;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Program;
use InvalidArgumentException;

class ProgramController extends Controller
{
    use StoresOptimizedImages;

    public function index()
    {

        $data = DB::table('programs')->latest()->get();
        return view('admin.programs', ['data'=>$data]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => app(ImageUploadService::class)->validationRules(true, true),
        ]);

        try {
            $fileName = $this->storeOptimizedImage($request->file('image'), 'images/programs');
        } catch (InvalidArgumentException $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

        // Generate slug

        $slug = Str::of($request->input('title'))->slug();

        $program = Program::firstOrCreate(
            ['slug' => $slug],
            [
            'title' =>$request->input('title'),
            'description' =>$request->input('description'),
            'image' => $fileName,
            'slug' => $slug
        ]
            );

            return redirect('progras')->with('success','Program added successfuly!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Program::find($id);
        return view('admin.programUpdate', ['data'=>$data]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => app(ImageUploadService::class)->validationRules(true, false),
        ]);

        $data = Program::find($id);
        // $data->branch_id = $request->input('branch_id');
        $data->title = $request->input('title');
        $data->description = $request->input('description');

        if(!$data){
            return back()->with('Error','Program Not Found');
        }

        try {
            if ($request->hasFile('image')) {
                $data->image = $this->storeOptimizedImage(
                    $request->file('image'),
                    'images/programs',
                    true,
                    $data->image
                );
            }
        } catch (InvalidArgumentException $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

        $data->update();

        return redirect('progras')->with('success','Program has been updated');
    }

    public function destroy($id)
    {
        $data = Program::find($id);
        $data->delete($id);
        return redirect()->back()->with('success', 'Item has been deleted');
    }
}
