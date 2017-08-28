<?php
namespace Sender;

use Sender\Deliver;
use Sender\SmsClass;
use Sender\MobileNumber;
use Sender\Exception\InvalidParameterException;

/**
* This class for send MSG91 Transactional SMS
*/

class TransactionalSms
{
    public function __construct()
    {
    }

    /**
    *  Send transactional SMS MSG91 Service
    * @param  $mobileNumber  int OR string
    * @param  $data
    *
    * @return array(Json format)
    *
    * @throws error missing parameters or return empty
    */
    public function sendTransactional($mobileNumber, $data)
    {
        //transactional SMS content
        $sendData = array(
            'authkey'     => "170867ARdROqjKklk599a87a1",
            'route'       => 4,
        );
        $buildedTransSmsData = SmsClass::buildSmsDataArray($mobileNumber, $data, $sendData);
        if ((sizeof($data)+3) == sizeof($buildedTransSmsData)) {
            $uri      = "sendhttp.php";
            $response = Deliver::sendOtpGet($uri, $buildedTransSmsData);
            return $response;
        } else {
            throw InvalidParameterException::missinglogic("Check second parameter, correct or wrong");
        }
    }
}
