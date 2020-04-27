<?php

namespace App\Http\Controllers;

use App\BloodType;
use Illuminate\Http\Request;

class BloodTypeController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Blood Type';
        $blood = BloodType::orderBy('name', 'asc')->select('name','id')->get();
        return view('pages.blood_type.view',compact('title','blood'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        dd('lolo');
        $title = 'Add Blood Type';
        return view('pages.blood_type.add',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:blood_types',
        ]);

        try {
            $create = BloodType::create([
                'name' => $request->name,
            ]);
            if ($create){
                return redirect('blood_type')->with('success', trans('Blood Group '.$request->name.' created successfully.'));
            }
        } catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
                return back()->with('error', trans('Duplicate entry'))->withInput($request->input());
            }
        }
        return back()->with('error', trans('something_went_wrong'))->withInput($request->input());
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
        $title = 'Blood Type';
        $blood = BloodType::where('id', $id)->first();
//        dd($blood);
        return view('pages.blood_type.edit',compact('title','blood'));
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
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:blood_types',
        ]);

        try {
            $update = BloodType::whereId($id)->update([
                'name' => $request->name,
            ]);
            if ($update){
                return redirect('blood_type')->with('success', trans('Blood Group '.$request->name.' updated successfully.'));
            }
        } catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
                return back()->with('error', trans('Duplicate entry'))->withInput($request->input());
            }
        }
        return back()->with('error', trans('something_went_wrong'))->withInput($request->input());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $content = BloodType::findOrFail($id)->delete();
        return response()->json(['success' => 'BloodType deleted successfully.']);
    }
}
