<?php
namespace Sender;

use Sender\ExceptionClass\ParameterException;

/**
 * This Class for splite mobile number given string
 *
 * @package    Sender\MobileNumber
 * @author     VenkatS <venkatsamuthiram5@gmail.com>
 * @link       https://github.com/tesark/msg91-php
 * @license    MIT
 */

class MobileNumber
{
    /**
     * This function provide valid mobile number array
     *
     * @param string $mobileNumber
     *
     * @return array|boolean Mobile numbers
     */
    public static function isValidNumber($mobileNumber)
    {
        if (isset($mobileNumber) && is_string($mobileNumber)) {
            $data = self::checkMobileLengthAndSize($mobileNumber);
            return $data;
        } else {
            return false;
        }
    }
    protected static function checkMobileLengthAndSize($mobileNumber)
    {
        $data = [];
        $mobiles = explode(",", $mobileNumber);
        $len     = sizeof($mobiles);
        if ($len < 20) {
            for ($i = 0; $i < $len; $i++) {
                $lenva = strlen($mobiles[$i]);
                if (is_numeric($mobiles[$i]) && $lenva >= 8 && $lenva < 15) {
                    if ($i == $len-1) {
                        $data += ["value" => true];
                        $data += ["mobile" => $mobiles];
                    }
                } else {
                    $data += ["value" => false];
                    $data += ["mobile" => $mobiles[$i]];
                }
            }
        } else {
            $message = "Minimum 20 mobile numbers";
            throw ParameterException::missinglogic($message);
        }
        return $data;
    }
}
