<?php
namespace Sender;

use PHPUnit\Framework\TestCase;
use Sender\TransactionalSms;
use Sender\ExceptionClass\ParameterException;

/**
* This test class for testing TransactionSms class
*/

class TransactionalSmsTest extends TestCase
{
    public $TransactionSms;
    public function setUp()
    {
        $this->TransactionSms = new TransactionalSms("170867ARdROqjKklk599a87a1");
    }
    public function tearDown()
    {
        $this->TransactionSms = null;
    }
    //-----------------------Send TransactionSms------------------------
    //------Test mandatory fields with integer type mobile numbers------
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testTransactionalSmsMandatoryFieldsMissingMessageIntegerMobile()
    {
        $sendArray = [
           'sender'   => 'UTOOWE',
        ];
        // "919514028541,919791466728,918807158824,917010942972"
        $verifyResponse   = $this->TransactionSms->sendTransactional(9514028541,$sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testTransactionalSmsMandatoryFieldsMissingSenderIntegerMobile()
    {
        $sendArray = [
           'message'  => 'WELCOME TO TESARK',
        ];
        // "919514028541,919791466728,918807158824,917010942972"
        $verifyResponse   = $this->TransactionSms->sendTransactional(9514028541,$sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testTransactionalSmsMandatoryFieldsMissingIntegerMobile()
    {
        $sendArray = [];
        // "919514028541,919791466728,918807158824,917010942972"
        $verifyResponse   = $this->TransactionSms->sendTransactional(9514028541,$sendArray);
    }
    //------------------------Send TransactionSms---------------------------
    //----------Test mandatory fields with String type mobile numbers-------
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testTransactionalSmsMandatoryFieldsMissingMessageStringMobile()
    {
        $sendArray = [
           'sender'   => 'UTOOWE',
        ];
        $verifyResponse   = $this->TransactionSms->sendTransactional("919514028541,919791466728",$sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testTransactionalSmsMandatoryFieldsMissingSenderStringMobile()
    {
        $sendArray = [
           'message'  => 'WELCOME TO TESARK',
        ];
        $verifyResponse   = $this->TransactionSms->sendTransactional("919514028541,919791466728",$sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testTransactionalSmsMandatoryFieldsMissingStringMobile()
    {
        $sendArray = [];
        $verifyResponse   = $this->TransactionSms->sendTransactional("919514028541,919791466728",$sendArray);
    }
    //--------------------------------Country Code------------------------- 
    public function testTransactionalSmsWithCountryCodeInteger()
    {
        $sendArray = [
           'message'   => 'WELCOME TO TESARK',
           'sender'    => 'UTOOWE',
           'country'   => 91,
        ];
        $result = $this->TransactionSms->sendTransactional(9514028541,$sendArray);
        $this->assertEquals(24, strlen($result)); 
    }
    public function testTransactionalSmsWithOutCountryCodeInteger()
    {
        $sendArray = [
           'message'   => 'WELCOME TO TESARK',
           'sender'    => 'UTOOWE',
        ];
        $result = $this->TransactionSms->sendTransactional(919514028541,$sendArray);
        $this->assertEquals(24, strlen($result));
    }
    public function testTransactionalSmsWithCountryCodeString()
    {
        $sendArray = [
           'message'   => 'WELCOME TO TESARK',
           'sender'    => 'UTOOWE',
           'country'   => 91,
        ];
        $result = $this->TransactionSms->sendTransactional("9514028541,9791466728",$sendArray);
        $this->assertEquals(24, strlen($result)); 
    }
    public function testTransactionalSmsWithOutCountryCodeString()
    {
        $sendArray = [
           'message'   => 'WELCOME TO TESARK',
           'sender'    => 'UTOOWE',
        ];
        $result = $this->TransactionSms->sendTransactional("919514028541,919791466728",$sendArray);
        $this->assertEquals(24, strlen($result));
    }
    //---------------------------------Flash only ------------------------
    public function testTransactionalSmsFlash()
    {
        $sendArray = [
           'message' => 'WELCOME TO TESARK',
           'sender' => 'UTOOWE',
           'flash' => 1,
        ];
        $result   = $this->TransactionSms->sendTransactional(919514028541,$sendArray);
        $this->assertEquals(24, strlen($result));
    }
    public function testTransactionalSmsFlashCountryCode()
    {
        $sendArray = [
           'message' => 'WELCOME TO TESARK',
           'sender' => 'UTOOWE',
           'flash' => 1,
           'country' => 91,
        ];
        $result = $this->TransactionSms->sendTransactional(9514028541,$sendArray);
        $this->assertEquals(24, strlen($result));
    }
    //----------------------- Unicode ----------------------------
    public function testTransactionalSmsUnicode()
    {
         $sendArray = [ 
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'unicode'      => 1,
        ];
        $result = $this->TransactionSms->sendTransactional(919514028541,$sendArray);
        $this->assertEquals(24, strlen($result));
    }
    //---------------------- Schtime ------------------------------
    public function testTransactionalSmsSchtime()
    {
         $sendArray = [ 
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'schtime'      => "2020-01-01 10:10:00",
        ];
        $result  = $this->TransactionSms->sendTransactional(919514028541,$sendArray);
        $this->assertEquals(24, strlen($result));
    }
    //----------------------- Response---------------------------
    public function testTransactionalSmsResponse()
    {
        $sendArray = [ 
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'response'     => "json",
        ];
        $result  = $this->TransactionSms->sendTransactional(9514028541,$sendArray);
        $this->assertEquals(24, strlen($result));
    }
    // public function testTransactionalSmsWithoutCountryCode()
    // {
    //      $sendArray = [ 
    //        'message'      => 'WELCOME TO TESARK',
    //        'sender'       => 'UTOOWE',
    //        'country'      => 91,
    //        'flash'        => 1,
    //        'unicode'      => 1,
    //        'schtime'      => "2020-01-01 10:10:00",
    //        'response'     => "json",
    //        'afterminutes' => 10,
    //        'campaign'     => "venkat"
    //     ];
    //     // "919514028541,919791466728,918807158824,917010942972"
    //     $verifyResponse   = $traObject->sendTransactional(9514028541,$sendArray);
    //     var_dump($verifyResponse);
    // }
}    