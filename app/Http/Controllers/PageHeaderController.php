<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\StoresOptimizedImages;
use App\Models\PageHeader;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
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
        $validated = $request->validate([
            'headers' => 'required|array',
            'headers.*.title' => 'required|string|max:255',
            'headers.*.subtitle' => 'nullable|string|max:500',
            'headers.*.image' => app(ImageUploadService::class)->validationRules(true, false),
        ]);

        foreach ($validated['headers'] as $id => $row) {
            $header = PageHeader::findOrFail($id);

            $header->title = $row['title'];
            $header->subtitle = $row['subtitle'] ?? null;

            if ($request->hasFile("headers.{$id}.image")) {
                try {
                    $header->image = $this->storeOptimizedImage(
                        $request->file("headers.{$id}.image"),
                        'images/headers',
                        true,
                        $header->image
                    );
                } catch (InvalidArgumentException $e) {
                    return redirect()->back()->withInput()->with('error', $e->getMessage());
                }
            }

            $header->save();
        }

        return redirect()->route('pageHeaders')->with('success', 'Page headers updated successfully.');
    }
}
