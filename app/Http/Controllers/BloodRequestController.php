<?php

namespace App\Http\Controllers;

use App\BloodGroup;
use App\BloodRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Sms\smsTemplates;

class BloodRequestController extends Controller
{
    use smsTemplates;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $bld_grps = BloodGroup::with(['user'])->where('user_id','!=',Auth::user()->id)->orderBy("exp_date","asc")->get();
//        dd($bld_grps);
        return view('pages.request_blood',compact('title','bld_grps'));
    }

    public function requested_blood()
    {
//        dd(Auth::user()->id);
        $bld_grps = BloodRequest::with(['blood_groups'])->where('user_request_id','!=',Auth::user()->id)->where('status','=',0)->get();
//        dd($bld_grps);
        return view('pages.respond_req_blood',compact('title','bld_grps'));
    }

    public function approved_blood()
    {
//        dd(Auth::user()->id);
        $bld_grps = BloodRequest::with(['blood_groups'])->where('user_request_id','=',Auth::user()->id)->where('status','=',1)->get();
//        dd($bld_grps);
        return view('pages.approved_blood',compact('title','bld_grps'));
    }

    public function declined_blood()
    {
//        dd(Auth::user()->id);
        $bld_grps = BloodRequest::with(['blood_groups'])->where('user_request_id','=',Auth::user()->id)->where('status','=',2)->get();
//        dd($bld_grps);
        return view('pages.declined_blood',compact('title','bld_grps'));
    }

    public function accept_request_blood(Request $request)
    {
//        dd($request);
        $data = [
            'status' => 1,
            'user_respond_notes' => $request->accept_info,
        ];
        $update = BloodRequest::whereId($request->req_id)->update($data);
        $blood = BloodRequest::with(['userres','userreq'])->whereId($request->req_id)->first();

        $this->BloodAcceptRespondSms($blood);
//        dd($blood);
//        $req = BloodRequest::with(['blood_groups'])->whereId($request->req_id)->first();
//        $update = BloodGroup::whereId($req->blood_groups->id)->update(['request' => 0]);
//        dd($update);
        if ($update){
            return redirect('requested_blood')->with('success', trans('Request accepted successfully.'));
        }
        return back()->with('error', trans('something_went_wrong'))->withInput($request->input());
    }

    public function decline_request_blood(Request $request)
    {
//        dd($request);
        $data = [
            'status' => 2,
            'user_respond_notes' => $request->respond_info,
        ];
        $update = BloodRequest::whereId($request->req_id)->update($data);
        $blood = BloodRequest::with(['userres','userreq'])->whereId($request->req_id)->first();

        $this->BloodRejectRespondSms($blood);
//        dd($blood);
        if ($update){
            return redirect('requested_blood')->with('success', trans('Request rejected successfully.'));
        }
        return back()->with('error', trans('something_went_wrong'))->withInput($request->input());
    }

    public function request_blood(Request $request){
        $blood = BloodGroup::where('blood_num', $request->blood_num)->first();
        $userres = User::where('id', $blood->user_id)->first();
        $userreq = User::where('id', Auth::user()->id)->first();
//        dd($userres,$userreq);
        $data = [
            'user_request_id' => Auth::user()->id,
            'user_respond_id' => $blood->user_id,
            'blood_num' => $blood->blood_num,
            'blood_group' => $blood->blood_group,
            'status' => 0,
            'date_required' => $request->date_required,
            'date_respond' => null,
            'user_request_notes' => $request->any_info,
            'user_respond_notes' => null,
        ];
        $create = BloodRequest::create($data);
        /* updating the blood request to show that its requested */
        $update = BloodGroup::where('blood_num', $request->blood_num)->update(['request' => 1]);
        $this->BloodRespondSms($userres,$userreq,$blood);
        $this->BloodRequestSms($userreq,$userres,$blood);
//        dd($request,$blood);
        if ($create){
            return redirect('request_blood')->with('success', trans('Blood Group '.$blood->blood_group.' requested successfully.'));
        }
        return back()->with('error', trans('something_went_wrong'))->withInput($request->input());
    }

    public function cancel_request_blood(Request $request){

        $data = [
            'status' => 3,
            'user_request_cancel_notes' => $request->cancel_info,
        ];
        $update = BloodRequest::whereId($request->req_id)->update($data);
        $req = BloodRequest::with(['blood_groups'])->whereId($request->req_id)->first();
//        dd($req);
        $update = BloodGroup::whereId($req->blood_groups->id)->update(['request' => 0]);
//        dd($update);
        if ($update){
            return redirect('request_blood')->with('success', trans('Request cancelled successfully.'));
        }
        return back()->with('error', trans('something_went_wrong'))->withInput($request->input());
    }
}
