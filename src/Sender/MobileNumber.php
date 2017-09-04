<?php
namespace Sender;

use Propaganistas\LaravelPhone\PhoneNumber;

/**
* This Class for splite mobile number given string
*
* @package    Msg91 SMS&OTP package
* @author     VenkatS <venkatsamuthiram5@gmail.com>
* @link       https://github.com/venkatsamuthiram/deliver
* @license
*/

class MobileNumber
{
    // public function __construct($mobileNumber) {
    // 	$this->mobileNumber = $mobileNumber;
    // }

    public static function isValidNumber($mobileNumber)
    {
        if (isset($mobileNumber) && is_string($mobileNumber)) {
            $result  = '';
            $fail    = '';
            $data    = [];
            $mobiles = explode(",", $mobileNumber);
            $len     = sizeof($mobiles);
            for ($i = 0; $i < $len; $i++) {
                $lenva = strlen($mobiles[$i]);
                if ($lenva >9  && $lenva < 15) {
                    if ($i == $len-1) {
                        $data += ["value" => true];
                        $data += ["mobile" => $mobiles];
                    }
                } else {
                    $data += ["value" => false];
                    $data += ["mobile" => $mobiles[$i]];
                }
            }
            return $data;
        }
    }
}
