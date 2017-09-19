<?php
namespace Sender;

use Propaganistas\LaravelPhone\PhoneNumber;

/**
 * This Class for splite mobile number given string
 *
 * @package    Sender\MobileNumber
 * @author     VenkatS <venkatsamuthiram5@gmail.com>
 * @link       https://github.com/venkatsamuthiram/deliver
 * @license
 */

class MobileNumber
{
    /**
     * This function provide valid mobile number array
     *
     * @param string $mobileNumber
     *
     * @return array|boolean Mobile numbers
     */
    public static function isValidNumber($mobileNumber)
    {
        if (isset($mobileNumber) && is_string($mobileNumber)) {
            $data    = [];
            $mobiles = explode(",", $mobileNumber);
            $len     = sizeof($mobiles);
            for ($i = 0; $i < $len; $i++) {
                $lenva = strlen($mobiles[$i]);
                if ($lenva > 9 && $lenva < 15) {
                    if ($i == $len-1) {
                        $data = self::addData(true, $mobiles);
                    }
                } else {
                    $data = self::addData(false, $mobiles[$i]);
                }
            }
            return $data;
        } else {
            return false;
        }
    }
    /**
     * This function used for build array of true/false content
     * @param bool  $status
     * @param array $data
     *
     * @return array
     */
    protected static function addData($status, $data)
    {
       $arrayData = [];
       $arrayData += ["value" => $status];
       $arrayData += ["mobile" => $data];
       return $arrayData;
    }
    /**
     * This function Add country code with mobilenumber
     *
     * @param  string $mobileNumber
     * @param  string $country
     *
     * @return string|boolean Added mobile with country code
     */
    public static function addCountryCode($mobileNumber, $country)
    {
        if (isset($mobileNumber) && isset($country)) {
            $mobile = (string) PhoneNumber::make($mobileNumber)->ofCountry($country);
            $value  = str_replace("+", "", $mobile); //remove "+"
            return $value;
        } else {
            return false;
        }
    }
    /**
     * This function Check country code correct or not
     *
     * @param string $mobileWithCountryCode
     * @param string $country
     *
     * @return boolean Checked mobile with country code vaild
     */
    public static function isVaildCountryCode($mobileWithCountryCode, $country)
    {
        if (isset($mobileWithCountryCode) && isset($country)) {
            $value = substr_replace($mobileWithCountryCode, "+", 0, 0); //add "+" infront of mobile for validation
            $isCorrect = PhoneNumber::make($value)->isOfCountry($country);
            return $isCorrect;
        } else {
            return false;
        }
    }
}
