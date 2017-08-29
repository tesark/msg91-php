<?php
namespace Sender;

use DateTime;

/**
* this class for Validation functions
*/

class Validation
{

    //Check validate date time format
    public function isValidDateFirstFormat($date, $format = 'Y-m-d h:i:s')
    {
        $date = trim($date);
        $d    = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
    public function isValidDateSecondFormat($date, $format = 'Y/m/d h:i:s')
    {
        $date = trim($date);
        $d    = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
    //Test Unix Timestamp
    public function isValidTimeStamp($timestamp)
    {
        $timestamp = trim($timestamp);
        if (is_int($timestamp)) {
            if (strtotime("-1 minutes") === $timestamp) {
                return true;
            }
        } else {
            return false;
        }
    }
    //build minutes to datetime string
    public function getDateTime($minutes)
    {
        $value   = trim($minutes);
        $minutes = "+".$value."minutes";
        return date("Y/m/d h:i:s", strtotime($minutes));
    }
}
