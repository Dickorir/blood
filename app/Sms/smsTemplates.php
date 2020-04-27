<?php
namespace App\Sms;
use AfricasTalkingGateway;
use AfricasTalkingGatewayException;
use App\Sms\sendsms;
use SimpleXMLElement;

trait smsTemplates
{
    use sendsms;

    //send registration code to new user
    public function BloodRequestSms($userreq,$userres,$blood)
    {
        $messages = "You have requested blood: " . $blood->blood_group . " from " . $userres->name;
        $recepient = $userreq->tel;
//        dd($messages);
        $this->sendSms($messages, $recepient);
    }

    //send forgot txt code to user
    public function BloodRespondSms($userres,$userreq,$blood)
    {
        $messages = "You have been requested for blood: " . $blood->blood_group . " by " . $userreq->name;
        $recepient = $userres->tel;
        $this->sendSms($messages, $recepient);
    }

    // send sms to person requesting land
    public function BloodAcceptRespondSms($blood)
    {
        $messages = "Your request for blood: " . $blood->blood_group . " have been approved by " . $blood->userres->name;
        $recepient = $blood->userreq->tel;
//        dd($recepient);
        $this->sendSms($messages, $recepient);
    }
    public function BloodRejectRespondSms($blood)
    {
        $messages = "Your request for blood: " . $blood->blood_group . " have been declined by " . $blood->userres->name;
        $recepient = $blood->userreq->tel;
//        dd($messages);
        $this->sendSms($messages, $recepient);
    }

    // send sms to person owning the land
    // <a href="{{ url('lender/landrequest',[$user->orderid => Crypt::encrypt($user->orderid)]) }}">
    public function LandOrderSms($user)
    {
//        $link  = new SimpleXMLElement('<a href="{{ url("lender/landrequest",[$user->orderid => Crypt::encrypt($user->orderid)]) }}">Click here</a>');
        $messages = "Farmallke: A request received for land {$user->farmname} by {$user->farmertel}";
        $recepient = $user->lendertel;
        $this->sendSms($messages, $recepient);
    }

    // send sms to person requesting machinery
    public function FarmerachineryPlaceOrderSms($user)
    {
        $messages = "Farmallke: Thank you requesting machinery {$user->farmname}";
        $recepient = $user->farmertel;
        $this->sendSms($messages, $recepient);
    }

    // send sms to person owning the machinery
    // <a href="{{ url('lender/landrequest',[$user->orderid => Crypt::encrypt($user->orderid)]) }}">
    public function MachineryOrderSms($user)
    {
//        $link  = new SimpleXMLElement('<a href="{{ url("lender/landrequest",[$user->orderid => Crypt::encrypt($user->orderid)]) }}">Click here</a>');
        $messages = "Farmallke: A request received for machinery {$user->farmname} by {$user->farmertel}";
        $recepient = $user->lendertel;
        $this->sendSms($messages, $recepient);
    }

    // send sms to person approving a request land
    public function FarmerLandApprovalSms($user)
    {
//        dd($user);
        $messages = "Farmallke: Your order on land $user->farmname has been approved ";
        $recepient = $user->farmertel;
        $this->sendSms($messages, $recepient);
    }

    // send sms to person approving a request machinery
    public function FarmerMachineryApprovalSms($user)
    {
//        dd($user);
        $messages = "Farmallke: Your order on machinery $user->farmname has been approved ";
        $recepient = $user->farmertel;
        $this->sendSms($messages, $recepient);
    }
}