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
    /**
    *This function provide valid mobile number array
    *Limittd 10 number only
    *
    * @param mobileNumber string
    * @return array
    */
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
        } else {
            return false;
        }
    }
    /**
    *This function Add country code with mobilenumber
    *
    * @param  mobileNumber string or numeric
    * @param  country      string
    * @return string       note:mobile With specific CountryCode
    */
    public static function addCountryCode($mobileNumber, $country)
    {
        if (isset($mobileNumber) && isset($country)) {
            $mobile = (string) PhoneNumber::make($mobileNumber)->ofCountry($country);
            $value  = str_replace("+", "", $mobile);//remove "+"
            return $value;
        } else {
            return false;
        }
    }
    /**
    *This function Check country code correct or not
    *
    * @param mobileWithCountryCode string
    * @param country               string
    * @return boolean
    */
    public static function isVaildCountryCode($mobileWithCountryCode, $country)
    {
        if (isset($mobileWithCountryCode) && isset($country)) {
            $value = substr_replace($mobileWithCountryCode, "+", 0, 0); //add "+" infront off mobile for validation
            $isCorrect = PhoneNumber::make($value)->isOfCountry($country);
            return $isCorrect;
        } else {
            return false;
        }
    }
}
