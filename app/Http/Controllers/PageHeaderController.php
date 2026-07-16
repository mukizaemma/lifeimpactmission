<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\StoresOptimizedImages;
use App\Models\PageHeader;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use InvalidArgumentException;

class PageHeaderController extends Controller
{
    use StoresOptimizedImages;

    public function index()
    {
        $headers = PageHeader::orderBy('label')->get();

        return view('admin.page-headers', ['headers' => $headers]);
    }

    public function update(Request $request)
    {
        $rules = [
            'headers' => 'required|array',
            'headers.*.title' => 'required|string|max:255',
            'headers.*.subtitle' => 'nullable|string|max:500',
        ];

        // Only validate image fields that were actually uploaded (empty file inputs
        // must not block title/subtitle saves).
        foreach ($request->file('headers', []) as $id => $files) {
            $file = $files['image'] ?? null;
            if ($file instanceof UploadedFile && $file->isValid()) {
                $rules["headers.{$id}.image"] = [
                    'nullable',
                    'image',
                    'mimes:jpeg,jpg,png,gif,webp',
                    'max:10240', // allow larger originals; server optimizes to 300–700KB
                ];
            }
        }

        $validated = $request->validate($rules);

        foreach ($validated['headers'] as $id => $row) {
            $header = PageHeader::findOrFail($id);

            $header->title = $row['title'];
            $header->subtitle = $row['subtitle'] ?? null;

            $uploaded = $request->file("headers.{$id}.image");
            if ($uploaded instanceof UploadedFile && $uploaded->isValid()) {
                try {
                    $header->image = $this->storeOptimizedImage(
                        $uploaded,
                        'images/headers',
                        true,
                        $header->image
                    );
                } catch (InvalidArgumentException $e) {
                    return redirect()
                        ->back()
                        ->withInput()
                        ->with('error', "{$header->label}: ".$e->getMessage())
                        ->withErrors(["headers.{$id}.image" => $e->getMessage()]);
                }
            }

            $header->save();
        }

        return redirect()
            ->route('pageHeaders')
            ->with('success', 'Page headers updated successfully.');
    }
}
