<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\StoresOptimizedImages;
use App\Models\Sponsorship;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use InvalidArgumentException;

class SponsorshipController extends Controller
{
    use StoresOptimizedImages;

    public function index()
    {
        $children = Sponsorship::latest()->get();
        return view('admin.sponsorship', ['children' => $children]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => app(ImageUploadService::class)->validationRules(true, false),
        ]);

        $data = new Sponsorship();
        $data->names = $request->names;
        $data->age = $request->age;
        $data->sex = $request->sex;
        $data->testimany = $request->testimany;
        $data->phone = $request->phone;
        $data->address = $request->address;

        try {
            if ($request->hasFile('image')) {
                $data->image = $this->storeOptimizedImage($request->file('image'), 'images/sponsorship');
            }
        } catch (InvalidArgumentException $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

        if ($data->save()) {
            return redirect('children')->with('success', 'New Child has been added successfully');
        }

        return redirect()->back()->with('error', 'Failed to add new Child');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Sponsorship::find($id);
        return view('admin.sponsorshipUpdate', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => app(ImageUploadService::class)->validationRules(true, false),
        ]);

        $data = Sponsorship::findOrFail($id);
        $data->names = $request->input('names');
        $data->age = $request->input('age');
        $data->sex = $request->input('sex');
        $data->testimany = $request->input('testimany');
        $data->phone = $request->input('phone');
        $data->address = $request->input('address');

        try {
            if ($request->hasFile('image')) {
                $data->image = $this->storeOptimizedImage(
                    $request->file('image'),
                    'images/sponsorship',
                    true,
                    $data->image
                );
            }
        } catch (InvalidArgumentException $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

        $data->save();

        return redirect('children')->with('success', 'Child has been updated');
    }

    public function destroy($id)
    {
        $data = Sponsorship::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('success', 'Item has been deleted');
    }
}
