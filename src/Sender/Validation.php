<?php
namespace Sender;

use DateTime;

/**
* This Class provide validation Functions
*
* @package    Msg91 SMS&OTP package
* @author     VenkatS <venkatsamuthiram5@gmail.com>
* @link       https://github.com/venkatsamuthiram/deliver
* @license
*/

class Validation
{
    /*
    * Check is String type
    */
    public static function isString($value)
    {
        return is_string($value);
    }
    /*
    * Check is integer type
    */
    public static function isInteger($value)
    {
        return is_int($value);
    }
    /*
    * Check is Numeric type
    */
    public static function isNumeric($value)
    {
        return is_numeric($value);
    }
    //Check validate date time format
    public static function isValidDateFirstFormat($date, $format = 'Y-m-d h:i:s')
    {
        $date = trim($date);
        $d    = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
    public static function isValidDateSecondFormat($date, $format = 'Y/m/d h:i:s')
    {
        $date = trim($date);
        $d    = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
    //Test Unix Timestamp
    public static function isValidTimeStamp($timestamp)
    {
        if (is_int($timestamp)) {
            $timestamp = (int) trim($timestamp);
            $min = strtotime("-1 minutes");
            if ($min <= $timestamp) {
                return true;
            }
        } else {
            return false;
        }
    }
    //Check afterminutes limits
    public static function isVaildAfterMinutes($afterMinutes)
    {
        $value  = array('options' => array('min_range' => 10,'max_range' => 20000));
        $result = filter_var($afterMinutes, FILTER_VALIDATE_INT, $value);
        return (bool) $result;
    }
}
