<?php

namespace App\Http\Controllers;

use App\Models\PageHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PageHeaderController extends Controller
{
    public function index()
    {
        $headers = PageHeader::orderBy('label')->get();

        return view('admin.page-headers', ['headers' => $headers]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'headers' => 'required|array',
            'headers.*.title' => 'required|string|max:255',
            'headers.*.subtitle' => 'nullable|string|max:500',
            'headers.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        foreach ($validated['headers'] as $id => $row) {
            $header = PageHeader::findOrFail($id);

            $header->title = $row['title'];
            $header->subtitle = $row['subtitle'] ?? null;

            if ($request->hasFile("headers.{$id}.image")) {
                if ($header->image && Storage::disk('public')->exists('images/headers/' . $header->image)) {
                    Storage::disk('public')->delete('images/headers/' . $header->image);
                }

                $file = $request->file("headers.{$id}.image");
                $filename = $header->page_key . '_' . time() . '_' . Str::random(5) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('images/headers', $filename, 'public');
                $header->image = $filename;
            }

            $header->save();
        }

        return redirect()->route('pageHeaders')->with('success', 'Page headers updated successfully.');
    }
}
