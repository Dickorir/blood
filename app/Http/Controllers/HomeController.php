<?php

namespace App\Http\Controllers;

use App\County;
use App\User;
use FarhanWazir\GoogleMaps\GMaps;
use FarhanWazir\GoogleMaps\Facades;
use FarhanWazir\GoogleMaps\Containers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $config['center'] = 'Air canada centre, Toronto';
        $config['zoom'] = '14';
        $config['map_height'] = '500px';
//        $config['map_width'] = '500px';
        $config['scrollwheel'] = false;

        (new \FarhanWazir\GoogleMaps\GMaps)->initialize($config);

        // add marker
        $marker['position'] = 'Air canada centre, Toronto';
        $marker['infowindow_content'] = 'Air canada centre';
        (new \FarhanWazir\GoogleMaps\GMaps)->add_marker($marker);

        $map = (new \FarhanWazir\GoogleMaps\GMaps)->create_map();

        return view('home')->with('map', $map);
    }

    public function profile()
    {
        $title = Auth::user()->name.' '.'profile';
        return view('pages.profile',compact('title'));
    }

    public function complete_profile()
    {
        $title = Auth::user()->name.' '.'profile';
        $county = County::orderBy("name","asc")->pluck("name","id");
//dd($county);
        return view('pages.complete_profile',compact('title','county'));
    }

    public function hf_bb()
    {
        $title = Auth::user()->name.' '.'profile';
        $county = County::orderBy("name","asc")->pluck("name","id");
//dd($county);
        return view('pages.hf_bb_info',compact('title','county'));
    }

    public function update_complete_profile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'tel' => 'required',
            'level' => 'required',
            'address' => 'required',
            'type' => 'required',
            'location' => 'required',
            'county' => 'required',
            'sub_county' => 'required',
        ]);
        $hos = User::findOrFail(Auth::user()->id);
        $input = $request->all();
//        dd($input);
        $hos->fill($input)->save();

        if ($hos){
            return redirect('health_facility')->with('success', trans('Health facility '.$request->name.' edited successfully.'));
        }
        return back()->with('error', trans('something_went_wrong'))->withInput($request->input());
    }

    public function log()
    {
        return view('login');
    }
}
