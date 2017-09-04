<?php
namespace Sender\Log;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
* This class for Log errors and store request and response status
*
* @package    Msg91 SMS&OTP package
* @author     VenkatS <venkatsamuthiram5@gmail.com>
* @link       https://github.com/venkatsamuthiram/deliver
* @license
*/

class Log
{
    private static $logger;
    private static $path;
    public function __construct($logIdentifier)
    {
        $log = isset($logIdentifier) ? $logIdentifier : 'PackageLog';
        // Create the logger
        self::$logger = new Logger($log);
        self::$path   = __DIR__;
    }

    /**
    *  MSG91 Error log "ERROR"
    * @param $error
    */
    public function error(...$error)
    {
        $error = array("ERROR" => $error);
        $dateTime = date_create('now')->format('Y-m-d');
        // Now add some handlers
        self::$logger->pushHandler(new StreamHandler(self::$path.'/Error_'.$dateTime.'.log', Logger::ERROR));
        self::$logger->error("\r\n \n TRACE:", $error);
    }

    /**
    *  MSG91 Error log "INFO"
    * @param $info
    */
    public function info(...$info)
    {
        $info = array('INFO' => $info);
        $dateTime = date_create('now')->format('Y-m-d');
        // Now add some handlers
        self::$logger->pushHandler(new StreamHandler(self::$path.'/Info_'.$dateTime.'.log', Logger::INFO));
        self::$logger->info("\r\n \n TRACE:", $info);
    }
}
