<?php
namespace Sender;

use DateTime;

/**
* this class for Validation functions
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
        $timestamp = trim($timestamp);
        if (is_int($timestamp)) {
            if (strtotime("-1 minutes") <= $timestamp) {
                return true;
            }
        } else {
            return false;
        }
    }
    //build minutes to datetime string
    public static function getDateTime($minutes)
    {
        $value   = trim($minutes);
        $minutes = "+".$value."minutes";
        return date("Y/m/d h:i:s", strtotime($minutes));
    }
}
