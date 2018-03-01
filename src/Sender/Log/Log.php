<?php
namespace Sender\Log;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Sender\ExceptionClass\ParameterException;

/**
 * This class for Log errors and store request and response status
 *
 * @package    Msg91 SMS&OTP package
 * @author     VenkatS <venkatsamuthiram5@gmail.com>
 * @link       https://github.com/tesark/msg91-php
 * @license    MIT
 */

class Log
{
    private static $logger;
    private static $path;
    public function __construct($logIdentifier)
    {
        $log = isset($logIdentifier) ? $logIdentifier : 'PackageLog';
        self::$logger = new Logger($log);
        self::$path   = __DIR__;
    }

    /**
     *  MSG91 Error log "ERROR"
     * @param error Array
     *
     */
    public function error(...$error)
    {
        $error = array("ERROR" => $error);
        $dateTime = date_create('now')->format('Y-m-d');
        self::$logger->pushHandler(new StreamHandler(self::$path.'/Logger'.'/Error_'.$dateTime.'.log', Logger::ERROR));
        self::$logger->error("\r\n \n TRACE:", $error);
    }

    /**
     *  MSG91 Error log "INFO"
     * @param info array
     *
     */
    public function info(...$info)
    {
        $info = array('INFO' => $info);
        $dateTime = date_create('now')->format('Y-m-d');
        self::$logger->pushHandler(new StreamHandler(self::$path.'/Logger'.'/Info_'.$dateTime.'.log', Logger::INFO));
        self::$logger->info("\r\n \n TRACE:", $info);
    }
    /**
     * This function for Delete automatially with in 10 days old files
     *
     */
    public function deleteOldFiles()
    {
        $path = self::$path.'/Logger';
        if ($handle = opendir($path)) {
            while (false !== ($file = readdir($handle))) {
                if ($file!='.' && $file!='..'){
                    $filelastmodified = filemtime($path."/".$file);
                    //10 days older files deleted
                    if ((time()-$filelastmodified) > 240 * 3600) {
                        $filepath = $path."/".$file;
                        @unlink($filepath);
                    }
            }   }
            @closedir($handle);
            if (@closedir($handle)) {
                throw ParameterException::missinglogic('The directory could not be created.');
            }
        }
    }
}
