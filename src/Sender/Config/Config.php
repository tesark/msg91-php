<?php
namespace Sender\Config;

use Noodlehaus\Config as Nood;
use Noodlehaus\AbstractConfig;

/**
* Default Config file
*
* @package    Sender\Config\Config
* @author     VenkatS <venkatsamuthiram5@gmail.com>
* @link       https://github.com/venkatsamuthiram/deliver
* @license
*/

class Config extends AbstractConfig// pending
{
    private $config;
    private $common;
    private $promotionalSms;
    private $transactionalSms;
    private $otp;
    private $hasCountry;
    private $hasTransAuth;
    private $hasPromoAuth;
    private $hasOtpAuth;
    public function __construct()
    {
        $file = $_SERVER["DOCUMENT_ROOT"]. '/../config';
        if (file_exists($file)) {
            $config = new Nood($file);
            if (isset($config['msg91'])) {
                if ($this->checkKey('common', $config['msg91'])) {
                    $this->common = $config['msg91']['common'];
                    //Check Config file variable present
                    $this->hasCountry    = $this->checkKey('country', $this->common);
                    $this->hasTransAuth  = $this->checkKey('transAuthKey', $this->common);
                    $this->hasPromoAuth  = $this->checkKey('promoAuthKey', $this->common);
                    $this->hasOtpAuth    = $this->checkKey('otpAuthKey', $this->common);
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
        } else {
            return false;
        }
    }
    /*
    * This function return Default and Env file Values
    *
    */
    public function getDefaults()
    {
        return array(
            'common' => [
                'country'      => getenv('COUNTRY')      ? (string) getenv('COUNTRY')      : $this->hasCountry ,
                'transAuthKey' => getenv('TRANSAUTHKEY') ? (string) getenv('TRANSAUTHKEY') : $this->hasTransAuth,
                'promoAuthKey' => getenv('PROMOAUTHKEY') ? (string) getenv('PROMOAUTHKEY') : $this->hasPromoAuth,
                'otpAuthKey'   => getenv('OTPAUTHKEY')   ? (string) getenv('OTPAUTHKEY')   : $this->hasOtpAuth,
            ],
            'promotionalSms' => [
                'sender' => getenv('SENDER') ? (string) getenv('SENDER') : $this->checkKey('sender', $this->promotionalSms),
            ],
            'transactionalSms' => [
                'sender' => getenv('SENDER') ? (string) getenv('SENDER') : $this->checkKey('sender', $this->transactionalSms),
            ],
            'otp' => [
                'sender'     => getenv('SENDER')    ? (string) getenv('SENDER') : $this->checkKey('sender', $this->otp),
                'otp_length' => getenv('OTPLENGTH') ? (int) getenv('OTPLENGTH') : (int) $this->checkKey('otp_length', $this->otp), // Length min 4 max 9
                'otp_expiry' => getenv('OTPEXPIRY') ? (int) getenv('OTPEXPIRY') : (int) $this->checkKey('otp_expiry', $this->otp), // Minutes default 1 day
            ]
        );
    }
    /**
    * This function check key present in array
    *
    * @param string $key Array key value
    * @param array  $array Check array
    *
    * @return string Return array value
    */
    protected function checkKey($key, $array)
    {
        if (isset($key) && is_array($array)) {
            if (array_key_exists($key, $array)) {
                return $array[$key];
            }
        }
    }
}
