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
    protected $config;
    protected $common;
    protected $promotionalSms;
    protected $transactionalSms;
    protected $otp;
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
    protected function getDefaults()
    {
        return array(
            'common' => [
                'country'      => getenv('COUNTRY')      ? (string) getenv('COUNTRY')      : $this->checkKey('country', $this->common),
                'transAuthKey' => getenv('TRANSAUTHKEY') ? (string) getenv('TRANSAUTHKEY') : $this->checkKey('transAuthKey', $this->common),
                'promoAuthKey' => getenv('PROMOAUTHKEY') ? (string) getenv('PROMOAUTHKEY') : $this->checkKey('promoAuthKey', $this->common),
                'otpAuthKey'   => getenv('OTPAUTHKEY')   ? (string) getenv('OTPAUTHKEY')   : $this->checkKey('otpAuthKey', $this->common),
            ],
            'promotionalSms' => [
                'sender' => getenv('SENDER') ? (string) getenv('SENDER') : $this->checkKey('sender', $this->promotionalSms),
            ],
            'transactionalSms' => [
                'sender' => getenv('SENDER') ? (string) getenv('SENDER') : $this->checkKey('sender', $this->transactionalSms),
            ],
            'otp' => [
                'sender'     => getenv('SENDER')    ? (string) getenv('SENDER')    : $this->checkKey('sender', $this->otp),
                'otp_length' => getenv('OTPLENGTH') ? ( int ) getenv('OTPLENGTH')  : $this->checkKey('otp_length', $this->otp), // Length min 4 max 9
                'otp_expiry' => getenv('OTPEXPIRY') ? ( int ) getenv('OTPEXPIRY')  : $this->checkKey('otp_expiry', $this->otp), // Minutes default 1 day
            ]
        );
    }
    /*
    *this function check key present in aaray
    *
    */
    protected function checkKey($key,$array)
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
