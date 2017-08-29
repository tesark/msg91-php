<?php
namespace Sender;

use PHPUnit\Framework\TestCase;
use Sender\PromotionalSms;

/**
* This test class use for testing Promotional SMS
*/

class PromotionalSmsTest extends TestCase
{
    private $PromoSms;
    protected function setUp()
    {
        $this->PromoSms = new PromotionalSms();
    }
    protected function tearDown()
    {
        $this->PromoSms = null;
    }
    //----------------------------------
    public function testsendPromotional()
    {
        $sendArray = [
           'message'      => "this is test value",
           'sender'       => "MSG91",
           'country'      => 91,
           'flash'        => 1,
           'unicode'      => 1,
           'schtime'      => "2020-01-01 10:10:00",
           'response'     => "json"
        ];

        $expectArray = [
           'authkey'     => "123456",
           'route'       => 1,
           'mobile'       => 9514028541,
           'message'      => "this is test value",
           'sender'       => "MSG91",
           'country'      => 91,
           'flash'        => 1,
           'unicode'      => 1,
           'schtime'      => "2020-01-01 10:10:00",
           'response'     => "json"
        ];
        $result = $this->PromoSms->sendPromotional(9514028541, $sendArray);
        $this->assertEquals($expectArray, $result);
    }
}
