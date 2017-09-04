<?php
namespace Sender\Config;

use Dotenv\Dotenv;

/**
* Config file
*
* @package    Msg91 SMS&OTP package
* @author     VenkatS <venkatsamuthiram5@gmail.com>
* @link       https://github.com/venkatsamuthiram/deliver
* @license    
*/

//Add Env file
$dotenv = new Dotenv($_SERVER['DOCUMENT_ROOT']);
$dotenv->load();

return [
    'settings' => [
        'common' => [
            'country'    => null,
            'transAuthKey' => getenv('TRANSAUTHKEY') ? (string)getenv('TRANSAUTHKEY') : '170867ARdROqjKklk599a87a1',
            'promoAuthKey' => getenv('PROMOAUTHKEY') ? (string)getenv('PROMOAUTHKEY') : '170867ARdROqjKklk599a87a1',
            'otpAuthKey'   => getenv('OTPAUTHKEY')   ? (string)getenv('OTPAUTHKEY')   : '170436A8DCExM8m259969531',
        ],
        'promotionalSms' => [
            'sender' => getenv('SENDER') ? (string)getenv('SENDER') : null,
        ],
        'transactionalSms' => [
            'sender' => getenv('SENDER') ? (string)getenv('SENDER'): null,
        ],
        'otp' => [
            'sender' => getenv('SENDER') ? (string)getenv('SENDER') : null,
        ]
    ]
];