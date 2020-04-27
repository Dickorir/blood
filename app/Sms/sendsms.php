<?php
namespace App\Sms;
use AfricasTalkingGateway;
use AfricasTalkingGatewayException;
use SimpleXMLElement;

trait sendsms // all sms sent from the system are sent through this sendSms
{
    public function sendSms($messages,$recepient)
    {
        require_once(public_path('../app/AfricasTalkingGateway.php'));

        $username   = "Dickilla";
        $apikey     = "337f69fe430fe6668eee4121cee61a08b00bcf0de0c595eca7ff9703729631c8";
//
//        $username   = "sandbox";
//        $apikey     = "e04fda58682e7d8111c5bcd357f094ab4ab6f51a43fc5b875ce463d8d8af3b10";

        /*$recipients = "+254714522718,+254733YYYZZZ";*/
        $recipients = $recepient;

        $message = $messages;

//        $gateway  = new AfricasTalkingGateway($username, $apikey, "sandbox");
        $gateway  = new AfricasTalkingGateway($username, $apikey);

        try
        {
            // Thats it, hit send and we'll take care of the rest.
            $results = $gateway->sendMessage($recipients, $message);

            foreach($results as $result) {
                // status is either "Success" or "error message"
                echo " Number: " .$result->number;
                echo " Status: " .$result->status;
                echo " MessageId: " .$result->messageId;
                echo " Cost: "   .$result->cost."\n";
            }
        }
        catch ( AfricasTalkingGatewayException $e )
        {
            echo "Encountered an error while sending: ".$e->getMessage();
        }
// DONE!!!
    }
}
