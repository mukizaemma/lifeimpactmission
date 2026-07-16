<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\StoresOptimizedImages;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Event;
use InvalidArgumentException;

class EventController extends Controller
{
    use StoresOptimizedImages;

    public function index()
    {
        $events = DB::table('events')->latest()->get();
        return view('admin.events', ['events'=>$events]);
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

        $slug = Str::of($request->input('title'))->slug();

        $data = new Event();
        $data ->title = $request->title;
        $data ->description = $request->description;
        $data ->location = $request->location;
        $data ->date = $request->date;
        $data ->timeStart = $request->timeStart;
        $data ->timeEnd = $request->timeEnd;
        $data ->registerLink = $request->registerLink;
        $data ->registerContact = $request->registerContact;
        $data ->slug = $slug;


        try {
            if ($request->hasFile('image')) {
                $data->image = $this->storeOptimizedImage($request->file('image'), 'images/events');
            }
        } catch (InvalidArgumentException $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

        $stored = $data->save();

        if($stored){
            return redirect('events')->with('success', 'New Event has been added successfuly');
        }

        return redirect()->back()->with('error','Failed to add new Event');
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
        $data = Event::find($id);
        return view('admin.eventUpdate', ['data'=>$data]);
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

        $data = Event::find($id);
        $data->title = $request->input('title');
        $data->location = $request->input('location');
        $data->date = $request->input('date');
        $data->timeStart = $request->input('timeStart');
        $data->timeEnd = $request->input('timeEnd');
        $data->registerLink = $request->input('registerLink');
        $data->registerContact = $request->input('registerContact');
        $data->status = $request->input('status');
        $data->description = $request->input('description');

        if(!$data){
            return back()->with('Error','Event Not Found');
        }

        try {
            if ($request->hasFile('image')) {
                $data->image = $this->storeOptimizedImage(
                    $request->file('image'),
                    'images/events',
                    true,
                    $data->image
                );
            }
        } catch (InvalidArgumentException $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

        $data->update();

        return redirect('events')->with('success','Event has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Event::find($id);
        $data->delete($id);
        return redirect()->back()->with('success', 'Item has been deleted');
    }
}
