<?php
namespace Sender;

use PHPUnit\Framework\TestCase;
use Sender\Validation;

/**
* This test calss use for tesing Validation Call
*/

class ValidationTest extends TestCase
{
    private $validate;
    protected function setUp()
    {
        $this->validate = new Validation();
    }
    protected function tearDown()
    {
        $this->validate = null;
    }
    //----------------------------
    public function testisValidDateFirstFormat()
    {
        $result = $this->validate->isValidDateFirstFormat("2020-01-01 10:10:00");
        $this->assertTrue($result);
    }

    public function testisValidDateFirstFormatFalse()
    {
        $result = $this->validate->isValidDateFirstFormat("2020/01/01 10:10:00");
        $this->assertFalse($result);
    }

    public function testisValidDateSecondFormat()
    {
        $result = $this->validate->isValidDateSecondFormat("2020/01/01 10:10:00");
        $this->assertTrue($result);
    }

    public function testisValidDateSecondFormatFalse()
    {
        $result = $this->validate->isValidDateSecondFormat("2020-01-01 10:10:00");
        $this->assertFalse($result);
    }

    public function testisValidTimeStamp()
    {
        $result = $this->validate->isValidTimeStamp("1577873400");
        $this->assertTrue($result);
    }

    public function testisValidTimeStampFalse()
    {
        $result = $this->validate->isValidTimeStamp("2020-01-01 10:10:00");
        $this->assertFalse($result);
    }
}
