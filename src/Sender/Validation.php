<?php
namespace Sender;

use DateTime;

/**
* This Class provide validation Functions
*
* @package    Msg91 SMS&OTP package
* @author     VenkatS <venkatsamuthiram5@gmail.com>
* @link       https://github.com/tesark/msg91-php
* @license    MIT
*/

class Validation
{
    /**
     * Check is String type
     * @param string $value
     *
     * @return bool
     */
    public static function isString($value)
    {
        return is_string($value);
    }
    /**
     * Check is integer type
     * @param int $value
     *
     * @return bool
     */
    public static function isInteger($value)
    {
        return is_int($value);
    }
    /**
     * Check is Numeric type
     * @param string $value
     *
     * @return bool
     */
    public static function isNumeric($value)
    {
        return is_numeric($value);
    }
    /**
     * This function for check auth key present or not
     *
     * @param string $authKey
     * @return bool
     */
    public static function isAuthKey($authKey)
    {
        if (isset($authKey) && is_string($authKey)) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Check validate date time format
     * @param string $date
     *
     * @return bool
     */
    public static function isValidDateFirstFormat($date, $format = 'Y-m-d h:i:s')
    {
        $date = trim($date);
        $d    = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
    /**
     * @param string $date
     *
     * @return bool
     */
    public static function isValidDateSecondFormat($date, $format = 'Y/m/d h:i:s')
    {
        $date = trim($date);
        $d    = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
    /**
     * Test Unix Timestamp
     * @param string $timestamp
     *
     * @return bool
     */
    public static function isValidTimeStamp($timestamp)
    {
        if (is_int($timestamp)) {
            $timestamp = (int) trim($timestamp);
            $max = strtotime("+1 minutes");
            $min = strtotime("-15 minutes");
            if ($min < $timestamp && $max > $timestamp) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    /**
     * This function get array the size
     * @param array $value
     *
     * return int Size fo the array
     */
    public static function getSize($value)
    {
        if (is_array($value)) {
            return sizeof($value);
        } else {
            return false;
        }
    }
}
