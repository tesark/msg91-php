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
 * @link       https://github.com/venkatsamuthiram/deliver
 * @license
 */

trait SmsBuildSecondTrait
{
    /**
     * This function add data to xml string
     *
     */
    public function addXml($buildSmsData, $xmlDoc, $key, $value)
    {
        if ($key === 'schtime') {
            $key = 'scheduledatetime';
        }
        $key = strtoupper(trim($key));
        //create a country element
        $buildSmsData->appendChild($xmlDoc->createElement($key, $value));
        return $buildSmsData;
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
            $message = "string comma seperate values";
            throw ParameterException::invalidInput("mobiles", "string or integer", $this->getmobile(), $message);
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
    /**
     * This function check the content length
     *
     *
     */
    public function checkContent($lenOfBulkSms,$bulkSms, $root, $category, $xmlDoc)
    {
        if ($lenOfBulkSms != 0) {
            for ($j = 0; $j < $lenOfBulkSms; $j++) {
                $this->inputData = $bulkSms[$j];
                $smsTag = $this->createElement($xmlDoc, "SMS", $root);
                //check message length
                $smsTag = $this->buildMessage($category, 'message', $smsTag, $xmlDoc);
                //check mobile contents
                $this->addMobileNumber($xmlDoc, $smsTag);
            }
        } else {
            $message = "content Empty";
            throw ParameterException::missinglogic($message);
        }
    }
}