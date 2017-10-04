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
    //------------Send TransactionSms----------
    public function testTransactionalSmsWithCountryCode()
    {
        $sendArray = [ 
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'country'      => 91,
        ];
        // "919514028541,919791466728,918807158824,917010942972"
        $verifyResponse   = $traObject->sendTransactional(9514028541,$sendArray);
        var_dump($verifyResponse);
    }
    public function testTransactionalSmsMessageOnly()
    {
        $sendArray = [ 
           'message'      => 'WELCOME TO TESARK',
        ];
        // "919514028541,919791466728,918807158824,917010942972"
        $verifyResponse   = $traObject->sendTransactional(919514028541,$sendArray);
        var_dump($verifyResponse);
    }
    public function testTransactionalSmsWithoutCountryCode()
    {
        $sendArray = [ 
           'sender'       => 'UTOOWE',
        ];
        // "919514028541,919791466728,918807158824,917010942972"
        $verifyResponse   = $traObject->sendTransactional(9514028541,$sendArray);
        var_dump($verifyResponse);
    }
    public function testTransactionalSmsCountryCodeOnly()
    {
        $sendArray = [ 
           'country'      => 91,
        ];
        // "919514028541,919791466728,918807158824,917010942972"
        $verifyResponse   = $traObject->sendTransactional(9514028541,$sendArray);
        var_dump($verifyResponse);
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
    
    // public function testTransactionalSmsWithoutCountryCode()
    // {
    //      $sendArray = [ 
    //        'message'      => 'WELCOME TO TESARK',
    //        'sender'       => 'UTOOWE',
    //        'flash'        => 1,
    //        'unicode'      => 1,
    //        'schtime'      => "2020-01-01 10:10:00",
    //        'response'     => "json",
    //        'afterminutes' => 10,
    //        'campaign'     => "venkat"
    //     ];
    //     // "919514028541,919791466728,918807158824,917010942972"
    //     $verifyResponse   = $traObject->sendTransactional(919514028541,$sendArray);
    //     var_dump($verifyResponse);
    // }
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