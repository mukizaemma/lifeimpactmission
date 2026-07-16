<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\StoresOptimizedImages;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Partner;
use InvalidArgumentException;

class PartnersController extends Controller
{
    use StoresOptimizedImages;

    public function index()
    {

        $data = DB::table('partners')->latest()->get();
        return view('admin.partners', ['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'image' => app(ImageUploadService::class)->validationRules(false, false),
        ]);

        $data = new Partner();
        $data->names = $request->names;
        $data ->facebook = $request->facebook;
        $data ->instagram = $request->instagram;
        $data ->twitter = $request->twitter;
        $data ->website = $request->website;
        $data ->description = $request->description;

        try {
            if ($request->hasFile('image')) {
                $data->image = $this->storeOptimizedImage($request->file('image'), 'images/partners', false);
            }
        } catch (InvalidArgumentException $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

        $stored = $data->save();

        if($stored){
            return redirect('partner')->with('success', 'New Partner has been added successfuly');
        }

        return redirect()->back()->with('error','Failed to add new Partner');
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Partner::find($id);
        return view('admin.partnerUpdate', ['data'=>$data]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => app(ImageUploadService::class)->validationRules(false, false),
        ]);

        $data = Partner::find($id);
        $data->names = $request->input('names');
        // $data->facebook = $request->input('facebook');
        // $data->instagram = $request->input('instagram');
        // $data->twitter = $request->input('twitter');
        $data->website = $request->input('website');
        $data->description = $request->input('description');

        if(!$data){
            return back()->with('Error','Partner Not Found');
        }

        try {
            if ($request->hasFile('image')) {
                $data->image = $this->storeOptimizedImage(
                    $request->file('image'),
                    'images/partners',
                    false,
                    $data->image
                );
            }
        } catch (InvalidArgumentException $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

        $data->update();

        return redirect('partner')->with('success','Partner has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Partner::find($id);
        $data->delete($id);
        return redirect()->back()->with('success', 'Item has been deleted');
    }
}
