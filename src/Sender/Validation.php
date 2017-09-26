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
            $min = strtotime("-1 minutes");
            if ($min <= $timestamp) {
                return true;
            }
        } else {
            return false;
        }
    }
    /**
     * Check afterminutes limits
     * @param string $afterMinutes
     *
     * @return bool
     */
    public static function isVaildAfterMinutes($afterMinutes)
    {
        $value  = array('options' => array('min_range' => 10, 'max_range' => 20000));
        $result = filter_var($afterMinutes, FILTER_VALIDATE_INT, $value);
        return (bool) $result;
    }
    /**
     * This function Check value 0 or 1
     *
     * @return int
     */
    public static function chackArray($value)
    {
        $responseFormat = array(0, 1);
        $value = in_array($value, $responseFormat) ? $value : null;
        return $value;
    }
    /**
     * This function get array the size
     * @param array $value
     *
     * return int Size fo the array
     */
    public static function getSize($value)
    {
        return sizeof($value);
    }
    /**
     * This function return String length
     * @param String $value
     *
     * @return int
     */
    public static function getLength($value)
    {
        return strlen($value);
    }
    /**
     * This function check expect value present in array
     * @param string $value
     * 
     */
    public static function checkResponse($value)
    {
        $responseFormat = array('xml', 'json');
        $responseVal = strtolower($value);
        $value = in_array($responseVal, $responseFormat) ? $responseVal : null;
        return $value;
    }
    /**
     * This function for test sender length
     * @param string $key
     * @param string $value
     * @param array $data
     * @param string $api
     * @param int $category
     * @param array $xmlDoc
     *
     */
    public static function validLength($key, $value, $data, $api, $category = null, $xmlDoc = null)
    {
        if (strlen($value) == 6) {
            if ($api === 'otp') {
                $data = $this->addArray($key, $value, $data);
            } else {
                $data = $this->buildData($category, $key, $value, $data, $xmlDoc);
            }    
        } else {
            $message = "String length must be 6 characters";
            throw ParameterException::invalidInput($key, "string", $value, $message);
        }
        return $data;
    }
}
