<?php
namespace Sender\Exception;

/**
*
*/
class ParameterException extends \Exception
{
    public static function invalidArrtibuteType($arrName, $arrtype, $value)
    {
        return new static("Invalid Arrtibute expect type:__".$arrtype."given:_". gettype($value)."params__".$arrName);
    }
    public static function invalidInput($arrName, $arrtype, $value, $message)
    {
        $message = $arrtype."for this params__".$arrName."given:".gettype($value)."Reason:".$message;
        return new static("Invalid Input expect type:__".$message);
    }
    public static function missinglogic($message)
    {
        return new static("Error exception:".$message);
    }
}
