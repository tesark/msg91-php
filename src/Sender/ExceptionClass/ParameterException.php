<?php
namespace Sender\ExceptionClass;

/**
* This class for
*
* @package    Msg91 SMS&OTP package
* @author     VenkatS <venkatsamuthiram5@gmail.com>
* @link       https://github.com/venkatsamuthiram/deliver
* @license
*/

class ParameterException extends \Exception
{
    /**
    * This function throw invalid exceptin without message
    * @param arrName
    * @param arrtype
    * @param value
    *
    */
    public static function invalidArrtibuteType($arrName, $arrtype, $value)
    {
        return new static("Invalid Arrtibute expect type:\t".$arrtype."\tgiven:\t". gettype($value)."\tparams:".$arrName);
    }
    /**
    *This function throw invalid exceptin with message
    * @param arrName
    * @param arrtype
    * @param value
    * @param message
    *
    */
    public static function invalidInput($arrName, $arrtype, $value, $message)
    {
        $message = $arrtype."\tparams:\t".$arrName."\tgiven:\t".gettype($value)."\tReason:\t".$message;
        return new static("Invalid Input expect type:\t".$message);
    }
    /**
    *This function throw message
    * @param message
    */
    public static function missinglogic($message)
    {
        return new static("Error exception:\t".$message);
    }
}
