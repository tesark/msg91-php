<?php
namespace sender;

use PHPUnit\Framework\TestCase;
use sender\PromotionalSms;

/**
* 
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
}    