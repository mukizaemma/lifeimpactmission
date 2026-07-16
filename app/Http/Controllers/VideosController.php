<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Video;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    public function index()
    {
        $data = Video::with('program')->latest()->get();
        $programs = Program::latest()->get();

        return view('admin.videos', [
            'data' => $data,
            'programs' => $programs,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'caption' => 'nullable|string|max:1000',
            'video_url' => ['required', 'string', 'max:500', 'regex:/youtu(\.be|be\.com)/i'],
            'program_id' => 'nullable|exists:programs,id',
            'status' => 'nullable|string|max:50',
            'sort_order' => 'nullable|integer|min:0',
        ], [
            'video_url.regex' => 'Please paste a valid YouTube URL (youtube.com or youtu.be).',
        ]);

        $data = new Video();
        $this->fillVideo($data, $request);

        if ($data->save()) {
            return redirect()->route('videosAdmin')->with('success', 'YouTube video has been added successfully.');
        }

        return redirect()->back()->with('error', 'Failed to add video.');
    }

    public function edit($id)
    {
        $data = Video::findOrFail($id);
        $programs = Program::latest()->get();

        return view('admin.videoUpdate', [
            'data' => $data,
            'programs' => $programs,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'caption' => 'nullable|string|max:1000',
            'video_url' => ['required', 'string', 'max:500', 'regex:/youtu(\.be|be\.com)/i'],
            'program_id' => 'nullable|exists:programs,id',
            'status' => 'nullable|string|max:50',
            'sort_order' => 'nullable|integer|min:0',
        ], [
            'video_url.regex' => 'Please paste a valid YouTube URL (youtube.com or youtu.be).',
        ]);

        $data = Video::findOrFail($id);
        $this->fillVideo($data, $request);

        if ($data->save()) {
            return redirect()->route('videosAdmin')->with('success', 'YouTube video has been updated successfully.');
        }

        return redirect()->back()->with('error', 'Failed to update video.');
    }

    public function destroy($id)
    {
        Video::findOrFail($id)->delete();

        return redirect()->route('videosAdmin')->with('success', 'Video deleted successfully.');
    }

    private function fillVideo(Video $data, Request $request): void
    {
        $data->title = $request->title;
        $data->caption = $request->caption;
        $data->video_url = $request->video_url;
        $data->program_id = $request->program_id ?: null;
        $data->status = $request->status ?: 'Active';
        $data->sort_order = (int) ($request->sort_order ?? 0);
        $data->thumbnail = null;
    }
}
