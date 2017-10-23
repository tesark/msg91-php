<?php
namespace Sender\Traits;

use Sender\Validation;
use Sender\MobileNumber;
use Sender\Sms\SmsDefineClass;
use Sender\Sms\SmsBuildClass;
use Sender\ExceptionClass\ParameterException;

/**
 * This trait for SMS OTP FUNCTIONS
 *
 * @package    Msg91 SMS&OTP package
 * @author     VenkatS <venkatsamuthiram5@gmail.com>
 * @link       https://github.com/tesark/msg91-php
 * @license    MIT
 */

trait SmsBuildSupportTrait
{
    /**
     * This function for check afterminutes
     * @param int $category
     * @param string $key
     * @param array $buildSmsData
     *
     */
    public function checkAfterMinutes($category, $key, $value, $buildSmsData)
    {
        if ($this->isVaildAfterMinutes($value)) {
            $buildSmsData = $this->buildData($category, $key, $value, $buildSmsData);
            return $buildSmsData;
        } else {
            $message = "Allowed between 10 to 20000 mintutes";
            throw ParameterException::invalidInput("afterminutes", "int", $value, $message);
        }
    }
    /**
     * This function for simplify afterminutes
     * @param int $category
     * @param string $key
     * @param array $buildSmsData
     *
     * @return array
     */
    public function simplifyAfterMinutes($category, $key, $buildSmsData, $value)
    {
        if ($this->isInterger($value)) {
            $buildSmsData = $this->checkAfterMinutes($category, $key, $value, $buildSmsData);
        } else {
            throw ParameterException::invalidArrtibuteType($key, "int", $value);
        }
        return $buildSmsData;
    }
    /**
     * This function for Add mobile number to XML
     * @param array $xmlDoc
     * @param array $smsTag
     *
     */
    public function addMobileToXml($xmlDoc, $smsTag, $result)
    {
        if (!empty($result) && $result['value'] == true) {
            $mobiles = $result['mobile'];
            $len = Validation::getSize($mobiles);
            for ($k = 0; $k < $len; $k++) {
                $addressTag = $smsTag->appendChild($xmlDoc->createElement("ADDRESS"));
                $childAttr = $xmlDoc->createAttribute("TO");
                $childText = $xmlDoc->createTextNode($mobiles[$k]);
                $addressTag->appendChild($childAttr)->appendChild($childText);
            }
        } else {
            $message = "string comma seperate values you given:".$result['mobile'];
            throw ParameterException::invalidInput("mobile", "string", $result['mobile'], $message);
        }
    }
    /**
     * This function for sms array Build with mobilenumbers
     * @param array $buildSmsData
     * @param int $category
     *
     * @throws ParameterException missing parameters or return empty
     * @return array
     */
    public function addMobile($buildSmsData, $category)
    {
        $key = '';
        if ($category === 1) {
            $key = 'mobiles';
        } else {
            $key = 'mobile';
        }
        $value = $this->categoryWiseAddedMobile();
        $buildSmsData = $this->checkIntegerOrString($key, $value, $buildSmsData, $category);
        return $buildSmsData;
    }
}
