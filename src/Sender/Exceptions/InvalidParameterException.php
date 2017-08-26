<?php
namespace Sender\Exception;

/**
* 
*/
class InvalidParameterException extends \Exception
{
    public static function invalidArrtibuteType($arrName, $arrtype, $value = null)
    {
        if (isset($value)) {
            return new static("Invalid Arrtibute, expect type:".$arrtype."given:". gettype($value)."for this".$arrName);
        } else {
            return new static("Invalid Arrtibute, expect type:".$arrtype."for this".$arrName);
        }
    }
    
    public static function invalidInput($arrName, $arrtype, $message = null, $value = null)
    {
        if (isset($value) && isset($message)) {
            return new static("Invalid Input, expect type:".$arrtype."for this".$arrName."Reason:".$message."given:".gettype($value));
        } elseif (isset($message) && !isset($value)) {
            return new static("Invalid Input, expect type:".$arrtype."for this".$arrName."Reason:".$message);
        } else {
            return new static("Invalid Input, expect type:".$arrtype."for this".$arrName);
        }
    }
}
