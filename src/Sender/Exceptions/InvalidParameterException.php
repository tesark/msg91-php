<?php
namespace Sender\Exception;

/**
* 
*/
class InvalidParameterException extends \Exception
{
    public static function invalidArrtibuteType($arrName, $arrtype, $value)
    {
        return new static("Invalid Arrtibute, expect type:".$arrtype."given:". gettype($value)."for this".$arrName);
    }
    
    public static function invalidInput($arrName, $arrtype, $value, $message)
    {
        return new static("Invalid Input, expect type:".$arrtype."for this".$arrName."given:".gettype($value)."Reason:".$message);
    }

    public static function missinglogic($message)
    {
    	return new static("Error exception:".$message);
    }
}
