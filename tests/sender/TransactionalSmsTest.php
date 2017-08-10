<?php
namespace sender;

use PHPUnit\Framework\TestCase;
use sender\TransactionalSms;

/**
* 
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
}    