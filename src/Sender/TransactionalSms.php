<?php
namespace Sender;

use Sender\Sms\SmsNormal;

/**
 * This Class provide Transactional SMS APIs
 *
 * @package    Msg91 SMS&OTP package
 * @author     VenkatS <venkatsamuthiram5@gmail.com>
 * @link       https://github.com/tesark/msg91-php
 * @license    MIT
 */

class TransactionalSms
{
    /**
     * Auth key
     * @var string $transAuthKey Transaction Auth key
     */
    protected $transAuthKey;
    public function __construct($authkey = null)
    {
        $this->transAuthKey = $authkey;
    }
    /**
     *  Send transactional SMS MSG91 Service
     * @param  int|string $mobileNumber
     * @param  array $data
     *
     * @return string
     */
    public function sendTransactional($mobileNumber, $data)
    {
        $sms = new SmsNormal();
        $transAuthKey = $this->transAuthKey;
        $data['mobile'] = $mobileNumber;
        $response = $sms->smsCategory($data, 1, $transAuthKey);
        return $response;
    }
}
