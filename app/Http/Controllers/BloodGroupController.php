<?php

namespace App\Http\Controllers;

use App\BloodGroup;
use App\BloodType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BloodGroupController extends Controller
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
        $bld_grps = BloodGroup::where('user_id',Auth::user()->id)->orderBy("exp_date","asc")->get();
//        dd($bld_grps);
        return view('pages.blood_group.view',compact('title','bld_grps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Add Blood Type';
        $blood_gs = BloodType::orderBy("name","asc")->pluck("name","id");

        return view('pages.blood_group.add',compact('title','blood_gs'));
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
//            'email' => 'email|unique:users,email,'.Auth::guard('system')->user()->id,
            'blood_group' => 'required',
            'units' => 'required',
            'date_donated' => 'required',
        ]);

        $order_no = 0;
        $ordnum = BloodGroup::latest()->first();
        if ($ordnum !== null){
            $order_no = $ordnum->id;
        }

        $blood_num = 'BLD_GRP_'.str_pad($order_no + 1,3, 0, STR_PAD_LEFT);

        $exp_date = Carbon::parse($request->date_donated)->addDays(42)->toDateString();

        $input = $request->all(); // Select all requests from the form
        $input['user_id']= Auth::user()->id; // select the auth Id as input
        $input['exp_date']= $exp_date; // select the auth Id as input
        $input['blood_num']= $blood_num; // select the auth Id as input
        $create = BloodGroup::create($input); // input to the landseeker model and assign it to news

        try {
            if ($create){
                return redirect('blood_group')->with('success', trans('Blood Group '.$request->name.' created successfully.'));
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
        $title = 'Blood Group';
        $blood = BloodGroup::where('id', $id)->first();
//        dd($blood);
        return view('pages.blood_group.edit',compact('title','blood'));
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
//            'email' => 'email|unique:users,email,'.Auth::guard('system')->user()->id,
            'blood_group' => 'required',
            'units' => 'required',
            'date_donated' => 'required',
        ]);

        $exp_date = Carbon::parse($request->date_donated)->addDays(42)->toDateString();
        $update = BloodGroup::findOrFail(Auth::user()->id);
        $input = $request->all();

        $input['exp_date']= $exp_date; // select the auth Id as input

        $update->fill($input)->save();

        if ($update){
            return redirect('blood_group')->with('success', trans('Blood Group '.$request->name.' edited successfully.'));
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
        $content = BloodGroup::findOrFail($id)->delete();
        return response()->json(['success' => 'BloodGroup deleted successfully.']);
    }
}
