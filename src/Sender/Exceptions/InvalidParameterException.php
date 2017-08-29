<?php
namespace Sender\Exception;

/**
* 
*/
class InvalidParameterException extends \Exception
{
    public static function invalidArrtibuteType($arrName, $arrtype, $value)
    {
        return new static("Invalid Arrtibute expect type:__".$arrtype."__given:_". gettype($value)."__for this params__".$arrName);
    }
    
    public static function invalidInput($arrName, $arrtype, $value, $message)
    {
        return new static("Invalid Input expect type:__".$arrtype."__for this params_".$arrName."__given:".gettype($value)."___Reason:".$message);
    }

    public static function missinglogic($message)
    {
    	return new static("Error exception:".$message);
    }
}
 