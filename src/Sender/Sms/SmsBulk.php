<?php
namespace Sender\Sms;

use DOMDocument;
use Sender\Deliver;
use Sender\Validation;
use Sender\MobileNumber;
use Sender\Config\Config as ConfigClass;
use Sender\ExceptionClass\ParameterException;

/**
 * This Class for send Bulk SMS
 *
 * @package    Msg91 SMS&OTP package
 * @author     VenkatS <venkatsamuthiram5@gmail.com>
 * @link       https://github.com/venkatsamuthiram/deliver
 * @license
 */

class SmsBulk extends SmsBuildClass
{
    /**
     * This function Used to send the SMS XML formated data to Deliver Class
     * @param array $xmlData
     *
     * @throws ParameterException missing parameters or type error
     * @return string MSG91
     */
    public function buildAndSendXmlSms($xmlData)
    {
        $this->inputData = $xmlData;
        if ($this->hasData()) {
            //create the xml document
            $xmlDoc = new \DOMDocument();
            //create the root element
            $root = $this->createElement($xmlDoc, "MESSAGE");
            //check Auth
            $root = $this->addAuth($root, 2, $xmlDoc);
            //Check Sender
            $root = $this->addSender($root, 2, $xmlDoc);
            //Check schtime
            $root = $this->addSchtime($root, 2, $xmlDoc);
            //Check campaign
            $root = $this->addCampaign($root, 2, $xmlDoc);
            //Check country
            $root = $this->addCountry($root, 2, $xmlDoc);
            //Check flash
            $root = $this->addFlash($root, 2, $xmlDoc);
            //Check unicode
            $root = $this->addUnicode($root, 2, $xmlDoc);
            //Check unicode
            $this->addContent($root, 2, $xmlDoc);
        } else {
            $message = "parameters Missing";
            throw ParameterException::missinglogic($message);
        }
        //make the output pretty
        $xmlDoc->formatOutput = true;
        $xmlData  = $xmlDoc->saveXML();
        $uri      = "postsms.php";
        $delivery = new Deliver();
        $response = $delivery->sendSmsPost($uri, $xmlData);
        return $response;
    }
}
