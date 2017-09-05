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
    public function __construct()
    {
        $config = new Config($_SERVER["DOCUMENT_ROOT"]. '/../config');
    }
    /*
    *This function return Default and Env file Values
    *
    */
    protected function getDefaults()
    {
        return array(
            'common' => [
                'country'      => getenv('COUNTRY')      ? (string) getenv('COUNTRY')      : 'IN',
                'transAuthKey' => getenv('TRANSAUTHKEY') ? (string) getenv('TRANSAUTHKEY') : '170867ARdROqjKklk599a87a1',
                'promoAuthKey' => getenv('PROMOAUTHKEY') ? (string) getenv('PROMOAUTHKEY') : '170867ARdROqjKklk599a87a1',
                'otpAuthKey'   => getenv('OTPAUTHKEY')   ? (string) getenv('OTPAUTHKEY')   : '170436A8DCExM8m259969531',
            ],
            'promotionalSms' => [
                'sender' => getenv('SENDER') ? (string) getenv('SENDER') : null,
            ],
            'transactionalSms' => [
                'sender' => getenv('SENDER') ? (string) getenv('SENDER'): null,
            ],
            'otp' => [
                'sender'     => getenv('SENDER')    ? (string) getenv('SENDER')    : null,
                'otp_length' => getenv('OTPLENGTH') ? (string) getenv('OTPLENGTH') : 4, // Length min 4 max 9
                'otp_expiry' => getenv('OTPEXPIRY') ? (string) getenv('OTPEXPIRY') : 1, // Minutes default 1 day
            ]
        );
    }
}
