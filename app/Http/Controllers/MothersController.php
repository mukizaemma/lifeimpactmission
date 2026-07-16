<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\StoresOptimizedImages;
use App\Models\Mother;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use InvalidArgumentException;

class MothersController extends Controller
{
    use StoresOptimizedImages;

    public function index()
    {
        $data = Mother::oldest()->get();

        return view('admin.mothers', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'names' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'program' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'story' => 'nullable|string',
            'video_url' => 'nullable|string|max:500',
            'quote' => 'nullable|string|max:500',
            'status' => 'nullable|string|max:50',
            'image' => app(ImageUploadService::class)->validationRules(true, true),
        ]);

        $data = new Mother();
        $this->fillMother($data, $request);
        $data->slug = Mother::makeSlug($request->names);

        try {
            if ($request->hasFile('image')) {
                $data->image = $this->storeOptimizedImage($request->file('image'), 'images/mothers');
            }
        } catch (InvalidArgumentException $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

        if ($data->save()) {
            return redirect()->route('mothersAdmin')->with('success', 'Mother profile has been added successfully.');
        }

        return redirect()->back()->with('error', 'Failed to add mother profile.');
    }

    public function edit($id)
    {
        $data = Mother::findOrFail($id);

        return view('admin.motherUpdate', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'names' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'program' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'story' => 'nullable|string',
            'video_url' => 'nullable|string|max:500',
            'quote' => 'nullable|string|max:500',
            'status' => 'nullable|string|max:50',
            'image' => app(ImageUploadService::class)->validationRules(true, false),
        ]);

        $data = Mother::findOrFail($id);
        $this->fillMother($data, $request);

        try {
            if ($request->hasFile('image')) {
                $data->image = $this->storeOptimizedImage(
                    $request->file('image'),
                    'images/mothers',
                    true,
                    $data->image
                );
            }
        } catch (InvalidArgumentException $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

        $data->save();

        return redirect()->route('mothersAdmin')->with('success', 'Mother profile has been updated.');
    }

    public function destroy($id)
    {
        $data = Mother::findOrFail($id);

        if ($data->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete('images/mothers/' . ltrim($data->image, '/'));
        }

        $data->delete();

        return redirect()->back()->with('warning', 'Mother profile has been deleted.');
    }

    private function fillMother(Mother $data, Request $request): void
    {
        $data->names = $request->input('names');
        $data->title = $request->input('title');
        $data->location = $request->input('location');
        $data->program = $request->input('program');
        $data->description = $request->input('description');
        $data->story = $request->input('story');
        $data->video_url = $request->input('video_url');
        $data->quote = $request->input('quote');
        $data->status = $request->input('status') ?: 'Active';
    }
}
