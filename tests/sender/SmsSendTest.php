<?php
namespace sender;

use PHPUnit\Framework\TestCase;
use sender\SmsSend;

/**
* 
*/
class SmsSendTest extends TestCase
{
	
    private $sms;
    protected function setUp()
    {
        $this->sms = new SmsSend();
    }
    protected function tearDown()
    {
        $this->sms = null;
    }
    //-----------------------------------
    public function testSendPromotional()
    {       
        $result = $this->otp->sendPromotional();
        $this->assertEquals($result, $result);
        
    }

    public function testSendTransactional()
    {
    	$result = $this->otp->sendTransactional();
        $this->assertEquals($result, $result);
    }

    public function testConvertArrayToXmlNormal()
    {
    	$result = $this->otp->convertArrayToXml();
        $this->assertEquals($result, $result);
    }
}