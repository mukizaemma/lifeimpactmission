<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\StoresOptimizedImages;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Team;
use InvalidArgumentException;

class StaffController extends Controller
{
    use StoresOptimizedImages;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $team = DB::table('teams')->latest()->get();
        return view('admin.team', ['team'=>$team]);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => app(ImageUploadService::class)->validationRules(true, true),
        ]);

        $data = new Team();
        $data ->names = $request->names;
        $data ->phone = $request->phone;
        $data ->position = $request->position;
        $data ->category = $request->category;
        $data ->facebook = $request->facebook;
        $data ->instagram = $request->instagram;
        $data ->twitter = $request->twitter;
        $data ->bio = $request->bio;

        try {
            if ($request->hasFile('image')) {
                $data->image = $this->storeOptimizedImage($request->file('image'), 'images/staff');
            }
        } catch (InvalidArgumentException $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

        $stored = $data->save();

        if($stored){
            return redirect('staff')->with('success', 'New Staff has been added successfuly');
        }

        return redirect()->back()->with('error','Failed to add new Staff');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Team::find($id);
        return view('admin.teamUpdate', ['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => app(ImageUploadService::class)->validationRules(true, false),
        ]);

        $data = Team::find($id);
        $data->names = $request->input('names');
        $data->phone = $request->input('phone');
        $data->position = $request->input('position');
        $data->category = $request->input('category');
        $data->facebook = $request->input('facebook');
        $data->instagram = $request->input('instagram');
        $data->twitter = $request->input('twitter');
        $data->bio = $request->input('bio');
        //$data->display = "Yes";

        if(!$data){
            return back()->with('Error','Staff Not Found');
        }

        try {
            if ($request->hasFile('image')) {
                $data->image = $this->storeOptimizedImage(
                    $request->file('image'),
                    'images/staff',
                    true,
                    $data->image
                );
            }
        } catch (InvalidArgumentException $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

        $data->update();

        return redirect('staff')->with('success','Staff Members has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Team::find($id);
        $data->delete($id);
        return redirect()->back()->with('success', 'Staff has been deleted');
    }
}
