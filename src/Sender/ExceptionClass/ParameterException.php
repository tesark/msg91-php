<?php
namespace Sender\ExceptionClass;

/**
 * This class for Parameter Exception
 *
 * @package    Sender\ExceptionClass\ParameterException
 * @author     VenkatS <venkatsamuthiram5@gmail.com>
 * @link       https://github.com/tesark/msg91-php
 * @license    MIT
 */

class ParameterException extends \Exception
{
    /**
     * This function throw invalid exceptin without message
     * @param string $arrName Arrtibute name
     * @param string $arrtype Arrtibute type
     * @param string $value   Acually given value
     *
     * @return string Exception message
     */
    public static function invalidArrtibuteType($arrName, $arrtype, $value)
    {
        return new static("Invalid Input expect type:\t".$arrtype."\tgiven:\t".gettype($value)."\tparams:".$arrName);
    }
    /**
     * This function throw invalid exceptin with message
     * @param string $arrName Arrtibute name
     * @param string $arrtype Arrtibute type
     * @param string $value   Acually given value
     * @param string $message Exception message
     *
     * @return string Exception message
     */
    public static function invalidInput($arrName, $arrtype, $value, $message)
    {
        $message = $arrtype."\tparams:\t".$arrName."\tgiven:\t".gettype($value)."\tReason:\t".$message;
        return new static("Invalid Input expect type:\t".$message);
    }
    /**
     * This function throw message
     * @param string $message
     *
     * @return string Exception message
     */
    public static function missinglogic($message)
    {
        return new static("Error exception:\t".$message);
    }
}
