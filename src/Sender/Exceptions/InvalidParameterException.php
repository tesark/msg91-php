<?php
namespace Sender\Exception;

/**
* 
*/
class InvalidParameterException extends \Exception
{
    public static function invalidArrtibuteType($arrName, $arrtype, $value)
    {
        return new static("Invalid Arrtibute:__ expect type:__".$arrtype."given:__". gettype($value)."for this params___".$arrName);
    }
    
    public static function invalidInput($arrName, $arrtype, $value, $message)
    {
        return new static("Invalid Input:__expect type:__".$arrtype."for this params__".$arrName."given:___".gettype($value)."Reason:__".$message);
    }

    public static function missinglogic($message)
    {
    	return new static("Error exception:__".$message);
    }
}
