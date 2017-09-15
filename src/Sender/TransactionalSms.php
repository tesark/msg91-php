<?php
namespace Sender;

use Sender\SmsClass;
use Sender\Validation;
use Sender\Config\Config as ConfigClass;

/**
* This Class provide Transactional SMS APIs
*
* @package    Msg91 SMS&OTP package
* @author     VenkatS <venkatsamuthiram5@gmail.com>
* @link       https://github.com/venkatsamuthiram/deliver
* @license
*/

class TransactionalSms
{
    /**
    * @var $transAuthKey Transaction Auth key
    */
    private $transAuthKey;
    public function __construct($authkey = null)
    {
        $this->transAuthKey = $authkey;
    }
    /**
    *  Send transactional SMS MSG91 Service
    * @param  int|string $mobileNumber
    * @param  array $data
    *
    * @return array
    */
    public function sendTransactional($mobileNumber, $data)
    {
        $checkAuth = Validation::checkAuthKey($this->transAuthKey);
        if (!$checkAuth) {
            // Get Envirionment variable and config file values
            $config          = new ConfigClass();
            $container       = $config->getDefaults();
        }
        //transactional SMS content
        $sendData = array(
            'authkey'     => $checkAuth ? $this->transAuthKey : $container['common']['transAuthKey'],
            'route'       => 4,
        );
        $sms = new SmsClass();
        $TransactionOutput = $sms->sendSms($mobileNumber, $data, $sendData);
        return $TransactionOutput;
    }
}
