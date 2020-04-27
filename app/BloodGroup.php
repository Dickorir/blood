<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BloodGroup extends Model
{
    protected $fillable = [
        'blood_num','blood_group', 'units', 'WBC','RBC', 'platelet', 'plasma','date_donated', 'exp_date', 'user_id', 'request', 'expired',
    ];

    public function user()
    {
        return $this->hasOne('App\User','id','user_id');
    }

    public function user2()
    {
        return $this->hasOne('App\User','id','user_id');
    }

    public function blood_request()
    {
        return $this->hasOne('App\BloodRequest','blood_num','blood_num');
    }

}
