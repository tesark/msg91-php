<?php
namespace sender;

/**
* 
*/
class Validation
{

    function __construct()
    {
    }

    //Check validate date time format

    function isValidDateFirstFormat($date, $format = 'Y-m-d h:i:s')
    {
        $date = trim ($date);
        $d    = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    function isValidDateSecondFormat($date, $format = 'Y/m/d h:i:s')
    {
        $date = trim ($date);
        $d    = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
        
    //Test Unix Timestamp
    function isValidTimeStamp($timestamp)
    {
        $timestamp = trim ($timestamp);
        return ((string) (int) $timestamp === $timestamp) 
            && ($timestamp <= PHP_INT_MAX)
            && ($timestamp >= ~PHP_INT_MAX);
    }
}