<?php
namespace sender;

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
        return ((string) (int) $timestamp === $timestamp)
            && ($timestamp <= PHP_INT_MAX)
            && ($timestamp >= ~PHP_INT_MAX);
    }
}
