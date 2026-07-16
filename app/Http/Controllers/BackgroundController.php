<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\StoresOptimizedImages;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use App\Models\Background;
use App\Models\Homepage;
use InvalidArgumentException;

class BackgroundController extends Controller
{
    use StoresOptimizedImages;

    public function background(){
        $data = background::first();
        if($data===null)
        {
            $data = new background();
            $data->description = 'Our Background';
            $data->save();
            $data = background::first();
        }

        return view('admin.background', ['data'=>$data]);
    }

public function saveBackg(Request $request)
{
    $request->validate([
        'description' => 'required|string',
        'agriculture_video_url' => 'nullable|url|max:500',
        'image' => app(ImageUploadService::class)->validationRules(true, false),
        'image1' => app(ImageUploadService::class)->validationRules(true, false),
        'image2' => app(ImageUploadService::class)->validationRules(true, false),
        'image3' => app(ImageUploadService::class)->validationRules(true, false),
    ]);

    $data = background::first();
    $data->description = $request->input('description');
    $data->donations = $request->input('donations');
    $data->agriculture_video_url = $request->input('agriculture_video_url') ?: null;

    try {
        if ($request->hasFile('image')) {
            $data->image = $this->storeOptimizedImage(
                $request->file('image'),
                'images',
                true,
                $data->image
            );
        }

        if ($request->hasFile('image1')) {
            $data->image1 = $this->storeOptimizedImage(
                $request->file('image1'),
                'images',
                true,
                $data->image1
            );
        }

        if ($request->hasFile('image2')) {
            $data->image2 = $this->storeOptimizedImage(
                $request->file('image2'),
                'images',
                true,
                $data->image2
            );
        }

        if ($request->hasFile('image3')) {
            $data->image3 = $this->storeOptimizedImage(
                $request->file('image3'),
                'images',
                true,
                $data->image3
            );
        }
    } catch (InvalidArgumentException $e) {
        return redirect()->back()->withInput()->with('error', $e->getMessage());
    }

    $data->save();

    return redirect()->back()->with('success', 'Background has been updated successfully');
}



}
