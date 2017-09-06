<?php
namespace Sender\Config;

use Noodlehaus\Config;
use Noodlehaus\AbstractConfig;

/**
* default Config file
*
* @package    Msg91 SMS&OTP package
* @author     VenkatS <venkatsamuthiram5@gmail.com>
* @link       https://github.com/venkatsamuthiram/deliver
* @license
*/

class MyConfig extends AbstractConfig // class testing pending
{
    public $config;
    public $common;
    public $promotionalSms;
    public $transactionalSms;
    public $otp;
    public function __construct()
    {
        $config = new Config($_SERVER["DOCUMENT_ROOT"]. '/../config');
        if (isset($config['msg91']) && $config['msg91']) {
            if ($this->checkKey('common', $config['msg91'])) {
                $this->common = $config['msg91']['common'];
            }
            if ($this->checkKey('promotionalSms', $config['msg91'])) {
                $this->promotionalSms   = $config['msg91']['promotionalSms'];
            }
            if ($this->checkKey('transactionalSms', $config['msg91'])) {
                $this->transactionalSms = $config['msg91']['transactionalSms'];
            }
            if ($this->checkKey('otp', $config['msg91'])) {
                $this->otp    = $config['msg91']['otp'];
            }
        }
    }
    /*
    *This function return Default and Env file Values  
    *
    */
    public function getDefaults()
    {
        //Check Config file variable present
        $hasCountry    = $this->checkKey('country', $this->common);
        $hasTransAuth  = $this->checkKey('transAuthKey', $this->common);
        $hasPromoAuth  = $this->checkKey('promoAuthKey', $this->common);
        $hasOtpAuth    = $this->checkKey('otpAuthKey', $this->common);
        return array(
            'common' => [
                'country'      => getenv('COUNTRY')      ? (string) getenv('COUNTRY')      : $hasCountry ,
                'transAuthKey' => getenv('TRANSAUTHKEY') ? (string) getenv('TRANSAUTHKEY') : $hasTransAuth,
                'promoAuthKey' => getenv('PROMOAUTHKEY') ? (string) getenv('PROMOAUTHKEY') : $hasPromoAuth,
                'otpAuthKey'   => getenv('OTPAUTHKEY')   ? (string) getenv('OTPAUTHKEY')   : $hasOtpAuth,
            ],
            'promotionalSms' => [
                'sender' => getenv('SENDER') ? (string) getenv('SENDER') : $this->checkKey('sender', $this->promotionalSms),
            ],
            'transactionalSms' => [
                'sender' => getenv('SENDER') ? (string) getenv('SENDER') : $this->checkKey('sender', $this->transactionalSms),
            ],
            'otp' => [
                'sender'     => getenv('SENDER')    ? (string) getenv('SENDER')    : $this->checkKey('sender', $this->otp),
                'otp_length' => getenv('OTPLENGTH') ? (int) getenv('OTPLENGTH')    : (int) $this->checkKey('otp_length', $this->otp), // Length min 4 max 9
                'otp_expiry' => getenv('OTPEXPIRY') ? (int) getenv('OTPEXPIRY')    : (int) $this->checkKey('otp_expiry', $this->otp), // Minutes default 1 day
            ]
        );
    }
    /**
    *this function check key present in aaray
    *
    * @param key    string
    * @param array  array
    * 
    * @return null or array value for specific value
    */
    protected function checkKey($key, $array)
    {
        if (isset($key) && $array) {
            if (array_key_exists($key, $array)) {
                return $array[$key];
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
}
