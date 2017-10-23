<?php
namespace Sender\Config;

use Noodlehaus\Config as Nood;
use Noodlehaus\AbstractConfig;

/**
 * Default Config file
 *
 * @package    Sender\Config\Config
 * @author     VenkatS <venkatsamuthiram5@gmail.com>
 * @link       https://github.com/tesark/msg91-php
 * @license    MIT
 */

class Config extends AbstractConfig// pending
{
    private $common;
    private $hasTransAuth;
    private $hasPromoAuth;
    private $hasOtpAuth;
    public function __construct()
    {
        $file = $_SERVER["DOCUMENT_ROOT"].'/../config';
        if (file_exists($file)) {
            $config = new Nood($file);
            if (isset($config['msg91'])) {
                if ($this->checkKey('common', $config['msg91'])) {
                    $this->common = $config['msg91']['common'];
                    //Check Config file variable present
                    $this->hasTransAuth = $this->checkKey('transAuthKey', $this->common);
                    $this->hasPromoAuth = $this->checkKey('promoAuthKey', $this->common);
                    $this->hasOtpAuth = $this->checkKey('otpAuthKey', $this->common);
                }
            }
        } else {
            return false;
        }
    }
    /*
     * This function return Default and Env file Values
     *
     */
    public function getDefaults()
    {
        return array(
            'common' => [
                'transAuthKey' => getenv('TRANSAUTHKEY') ? (string) getenv('TRANSAUTHKEY') : $this->hasTransAuth,
                'promoAuthKey' => getenv('PROMOAUTHKEY') ? (string) getenv('PROMOAUTHKEY') : $this->hasPromoAuth,
                'otpAuthKey'   => getenv('OTPAUTHKEY') ? (string) getenv('OTPAUTHKEY') : $this->hasOtpAuth,
            ],
        );
    }
    /**
     * This function check key present in array
     *
     * @param string $key Array key value
     * @param array  $array Check array
     *
     * @return string Return array value
     */
    protected function checkKey($key, $array)
    {
        if (isset($key) && is_array($array)) {
            if (array_key_exists($key, $array)) {
                return $array[$key];
            }
        }
    }
}
