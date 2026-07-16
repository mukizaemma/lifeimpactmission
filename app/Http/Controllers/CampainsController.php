<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\StoresOptimizedImages;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Campain;
use App\Models\Program;
use InvalidArgumentException;

class CampainsController extends Controller
{
    use StoresOptimizedImages;

    public function index()
    {
        $campain = Campain::latest()->get();
        $programs = Program::all();
        return view('admin.campains',['campain'=>$campain,'programs'=>$programs]);
    }

public function store(Request $request)
{
    $request->validate([
        'image' => app(ImageUploadService::class)->validationRules(true, false),
    ]);

    $fileName = null;
    try {
        if ($request->hasFile('image')) {
            $fileName = $this->storeOptimizedImage($request->file('image'), 'images/campaigns');
        }
    } catch (InvalidArgumentException $e) {
        return redirect()->back()->withInput()->with('error', $e->getMessage());
    }

    $slug = Str::slug($request->input('title'));

    $campaign = Campain::updateOrCreate(
        ['slug' => $slug],
        [
            'title' => $request->input('title'),
            'goal' => $request->input('goal'),
            'description' => $request->input('description'),
            'short_description' => $request->input('short_description'),
            'call_to_action' => $request->input('call_to_action'),
            'donation_url' => $request->input('donation_url'),
            'youtube_video' => $request->input('youtube_video'),
            'program_id' => $request->input('program_id'),
            'status' => $request->input('status', 'active'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'image' => $fileName ?? $request->input('existing_image'),
            'target_people' => $request->input('target_people'),
            'cost_per_person' => $request->input('cost_per_person'),
            'slug' => $slug
        ]
    );

    return redirect()->back()->with('success', 'New Campaign has been added successfully');
}



    public function edit($id)
    {
        $campain = Campain::find($id);
        $programs = Program::all();
        return view('admin.campainUpdate',['campain'=>$campain, 'programs'=>$programs]);
    }

public function update(Request $request, $id)
{
    $request->validate([
        'image' => app(ImageUploadService::class)->validationRules(true, false),
        'youtubeimg' => app(ImageUploadService::class)->validationRules(true, false),
    ]);

    $post = Campain::findOrFail($id);

    try {
        if ($request->hasFile('image')) {
            $post->image = $this->storeOptimizedImage(
                $request->file('image'),
                'images/campaigns',
                true,
                $post->image
            );
        }

        if ($request->hasFile('youtubeimg')) {
            $post->youtubeimg = $this->storeOptimizedImage(
                $request->file('youtubeimg'),
                'images/campaigns',
                true,
                $post->youtubeimg
            );
        }
    } catch (InvalidArgumentException $e) {
        return redirect()->back()->withInput()->with('error', $e->getMessage());
    }

    $post->title = $request->input('title');
    $post->description = $request->input('description');
    $post->short_description = $request->input('short_description');
    $post->donation_url = $request->input('donation_url');
    $post->program_id = $request->input('program_id');

    $newTitle = $request->input('title');
    if ($post->title !== $newTitle) {
        $slug = Str::slug($newTitle);
        $existing = Campain::where('slug', $slug)->where('id', '!=', $post->id)->first();
        if ($existing) {
            $suffix = 1;
            $newSlug = $slug . '-' . $suffix;
            while (Campain::where('slug', $newSlug)->where('id', '!=', $post->id)->exists()) {
                $suffix++;
                $newSlug = $slug . '-' . $suffix;
            }
            $slug = $newSlug;
        }
        $post->slug = $slug;
    }

    $updated =$post->save();
    if($updated){
    return redirect()->route('campainCrud')->with('success', 'Campaign updated successfully');
    }
    else{
        return redirect()->route('campainCrud')->with('error', 'Something Went Wrong');
    }
}

    
    

    public function updateRaised(Request $request, $id)
    {
        $campaign = Campain::findOrFail($id);
        $raised = $campaign->raised + $request->raised;
        $percentage = round(($raised / $campaign->goal) * 100);
        $campaign->raised = $raised;
        $campaign->percentage = $percentage;
        $campaign->save();
        return redirect()->back()->with('success', 'Raised amount updated successfully.');
    }

    public function resetGoalRaised(Request $request, $id)
    {
        $campain = Campain::findOrFail($id);
        $campain->raised = null;
        $campain->percentage = null;
        $campain->goal = null;
        $campain->save();
    
        return redirect()->back()->with('success', 'Goal and Raised amounts reset successfully');
    }
    

    public function destroy($id)
    {
        $post = Campain::findOrFail($id);

        // Delete the image file
        Storage::delete('public/images/campains/' . $post->image);

        // Delete the post
        $post->delete();

        return redirect()->back()->with('success', 'Campaign Deleted');
    }

}
