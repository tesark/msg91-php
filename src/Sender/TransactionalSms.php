<?php
namespace Sender;

use Sender\SmsClass;

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
    public static function sendTransactional($mobileNumber, $data)
    {
        //transactional SMS content
        $sendData = array(
            'authkey'     => "170867ARdROqjKklk599a87a1",
            'route'       => 4,
        );
        $sms = new SmsClass();
        $TransactionOutput = $sms->sendSms($mobileNumber, $data, $sendData);
        return $TransactionOutput;
    }
}
