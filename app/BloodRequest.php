<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BloodRequest extends Model
{

    protected $fillable = [
        'user_request_id','user_respond_id', 'blood_num', 'blood_group','status', 'date_required', 'date_respond','user_request_notes', 'user_respond_notes','user_request_cancel_notes',
    ];

    public function userres()
    {
        return $this->hasOne('App\User','id','user_respond_id');
    }

    public function userreq()
    {
        return $this->hasOne('App\User','id','user_request_id');
    }

    public function blood_groups()
    {
        return $this->hasOne('App\BloodGroup','blood_num','blood_num');
    }
}
