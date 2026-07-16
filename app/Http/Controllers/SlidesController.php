<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\StoresOptimizedImages;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Slide;
use InvalidArgumentException;

class SlidesController extends Controller
{
    use StoresOptimizedImages;

    public function index()
    {
        $slides = Slide::latest()->get();
        return view('admin.slides', ['slides' => $slides]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'image' => app(ImageUploadService::class)->validationRules(true, true),
        ]);

        $data = new Slide();
        $data->heading = $request->input('heading', 'Default Heading');
        $data->subheading = $request->input('subheading', 'Through vocational training, shelter, health care, and faith-centered mentorship.');

        try {
            if ($request->hasFile('image')) {
                $data->image = $this->storeOptimizedImage($request->file('image'), 'images/slides');
            }
        } catch (InvalidArgumentException $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

        if ($data->save()) {
            return redirect('slides')->with('success', 'New Image has been added successfully');
        }

        return redirect()->back()->with('error', 'Failed to add new Image');
    }

    public function edit($id)
    {
        $data = Slide::find($id);
        return view('admin.slideUpdate', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'image' => app(ImageUploadService::class)->validationRules(true, false),
        ]);

        $data = Slide::find($id);
        if (! $data) {
            return back()->with('Error', 'Image Not Found');
        }

        $data->heading = $request->input('heading');
        if ($request->filled('subheading')) {
            $data->subheading = $request->input('subheading');
        }

        try {
            if ($request->hasFile('image')) {
                $data->image = $this->storeOptimizedImage(
                    $request->file('image'),
                    'images/slides',
                    true,
                    $data->image
                );
            }
        } catch (InvalidArgumentException $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

        $data->update();

        return redirect('slides')->with('success', 'Image has been updated');
    }

    public function destroy($id)
    {
        $image = Slide::findOrFail($id);
        if ($image->image) {
            Storage::disk('public')->delete('images/slides/' . ltrim($image->image, '/'));
        }
        $image->delete();
        return redirect()->back()->with('warning', 'Item has been deleted');
    }
}
