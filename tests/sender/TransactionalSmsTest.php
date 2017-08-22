<?php
namespace sender;

use PHPUnit\Framework\TestCase;
use sender\TransactionalSms;

/**
* This test class use for testing TransactionalSMS
*/

class TransactionalSmsTest extends TestCase
{
    private $tranSms;
    protected function setUp()
    {
        $this->tranSms = new TransactionalSms();
    }
    protected function tearDown()
    {
        $this->tranSms = null;
    }
    //------------------------------------------
    public function testsendTransactional()
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
           'route'       => 4,
           'mobile'       => 9514028541,
           'message'      => "this is test value",
           'sender'       => "MSG91",
           'country'      => 91,
           'flash'        => 1,
           'unicode'      => 1,
           'schtime'      => "2020-01-01 10:10:00",
           'response'     => "json"
        ];
        $result = $this->tranSms->sendTransactional(9514028541, $sendArray);
        $this->assertEquals($expectArray, $result);
    }
}
