<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::all()->first();

        // get data from table sliders
        $sliders = Slider::orderBy('id', 'DESC')->get();
        return view('admin.slider.index', compact('sliders', 'setting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $setting = Setting::all()->first();

        return view('admin.slider.create', compact('setting'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate user input
        $this->validate(
            $request,
            [
                'Title' => 'required|unique:sliders',
                'Description' => 'required',
                'image' => 'required|mimes:png,jpg|max:2048',
            ],

        );
        $path = 'haya';
        // $path = time() . '.' . $request->file->extension();

        // $request->file->move(public_path('img'), $path);
        // $path = 'zeze';
        // insert data
        Slider::updateOrCreate([
            // 'user_id' => Auth::id(),
            'image' => $path,
            'title' => $request->Title,
            'description' => $request->Name,
            // 'is_published' => $request->is_published
        ]);

        // set flash message and redirect
        session()->flash('message', 'slider created successfully');
        return redirect()->route('sliders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        $setting = Setting::all()->first();

        // redirect to edit page and send data to this page from slider, automatic because we use artisan -mcr before.
        return view('admin.slider.edit', compact('slider', 'setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        // validate input
        $this->validate(
            $request,
            [
                'thumbnail' => 'required',
                'name' => 'required|unique:sliders,name,' . $slider->id
            ],
            // custom error message
            [
                'thumbnail.required' => 'Enter Thumbnail URL',
                'name.required' => 'Enter Name',
                'name.unique' => 'slider already exists'
            ]
        );

        //update data
        Slider::updateOrCreate(
            [
                'id' => $slider->id
            ],
            [
                'user_id' => Auth::id(),
                'thumbnail' => $request->thumbnail,
                'name' => $request->name,
                'slug' => str_slug($request->name),
                'is_published' => $request->is_published
            ]
        );

        // set flash message and redirect
        session()->flash('message', 'slider updated successfully');
        return redirect()->route('sliders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        // delete record
        $slider->delete();
        // $setting = Setting::all()->first();

        // set flash messsage and redirect
        session()->flash('del-message', 'slider Deleted Successfully');
        return redirect()->route('sliders.index');
    }
}
