# MSG91 SMS & OTP Composer Package

### Installation

Run the following command.

```sh
composer require venkatsamuthiram/deliver
```
```sh
"require": {
        "venkatsamuthiram/deliver": "dev-master"
        }
```
### Coding Standards

The entire library is intended to be PSR-1, PSR-2 compliant.

### Get in touch

If you have any suggestions, feel free to email me at venkatsamuthiram5@gmail.com or ping me on Twitter with @venkatskpi.

### SMS
 [Msg91 Send SMS](http://api.msg91.com/apidoc/textsms/send-sms.php) 
- `GET` Method
- `POST` Method

```sh
 GET
http://api.msg91.com/api/sendhttp.php?authkey=YourAuthKey&mobiles=919999999990,919999999999&message=message&sender=ABCDEF&route=4&country=0
```

| Parameter name | Data type   | Description
| -------------- | ---------   | -----------
| authkey *		| alphanumeric	|Login authentication key (this key is unique for every user)
| mobiles *		| integer		|	Keep numbers in international format (with country code), multiple numbers should be | separated by comma (,)
| message *		| varchar		|	Message content to send
| sender *		| varchar		|	Receiver will see this as sender's ID.
| route *		| 	varchar		|	If your operator supports multiple routes then give one route name. Eg: route=1 for promotional, route=4 for transactional SMS.
| country		| 	numeric		|	0 for international,1 for USA, 91 for India.
| flash			| integer 		|	(0/1)	flash=1 (for flash SMS)
| unicode		| 	integer 	|		(0/1)	unicode=1 (for unicode SMS)
| schtime		| date and time	|When you want to schedule the SMS to be sent. Time format could be of your choice you can use Y-m-d h:i:s (2020-01-01 10:10:00) Or Y/m/d h:i:s (2020/01/01 10:10:00) Or you can send unix timestamp (1577873400)
| afterminutes	| integer		|	Time in minutes after which you want to send sms.
| response		| 	varchar		|	By default you will get response in string format but you want to receive in other format (json,xml) then set this parameter. for example: &response=json or &response=xml
| campaign		| varchar		|		Campaign name you wish to create.

operator supports.

  - route=1 for promotional   
  - route=4 for transactional

# SMS API

## 1. SendTransactional & SendPromotional

### Input Data
- `$mobileNumber`
- `$data`

### API

```sh
use Sender\TransactionalSms;
sendTransactional($mobileNumber, $data)
```
```sh
use Sender\PromotionalSms;
sendPromotional($mobileNumber, $data)
```
## 2. SendBulkSms

### Input Data
- `$data`

### Sample Input Data

```sh
Tips 1: 
$sample = [
    [
        'authkey' => '170867ARdROqjKklk599a87a1',
        'sender'  => 'MULSMS',
        'schtime'=> '2016-03-31 11:17:39',
        'campaign'=> 'venkat',
        'country'=> '91',
        'flash'=> 1,
        'unicode'=> 1,
        'content' =>[ 
           [
           'message'    => 'welcome multi sms',
           'mobile' => '91951******1,91880******4,917******972'
           ],
           [
              'message'    => 'tesark world',
              'mobile' => '9195******41',918******824,917******972'
           ]
        ]
    ]  
];        
Tips 2:
$sample = [
    [
       'authkey' => '170867ARdROqjKklk599a87a1',
       'sender'  => 'MULSMS',
       'content' =>[ 
            [
                'message'    => 'welcome multi sms',
                'mobile' => '919******541',918******824,917******972'
            ],
            [
                'message'    => 'tesark world',
                'mobile' => '9195******41,91880******4,9170******72'
            ]
        ]
    ],
    [
       'authkey' => '170867ARdROqjKklk599a87a1',
       'sender'  => 'SUNSMS',
       'content' =>[ 
            [
                'message'    => 'hai how are u',
                'mobile' => '9195******41,918******824,9******2972'
            ],
            [
                'message'    => 'hai welcome',
                'mobile' => '9195******41,918******824,9******42972'
            ]
        ]
    ]
];
```
 
### API

```sh
use Sender\PromotionalSms;
sendBulkSms($data)
```

# Sample XML


# Sample Output
```sh
5134842646923e183d000075
```
>Note : Output will be request Id which is alphanumeric and contains 24 character like mentioned above. With this request id, delivery report can be viewed. If request not sent successfully, you will get the appropriate error message. View error codes

### SEND OTP
[Msg91 Send OTP](http://api.msg91.com/apidoc/sendotp/send-otp.php)
- `GET` Method

```sh
GET
http://api.msg91.com/api/sendotp.php?authkey=YourAuthKey&mobile=919999999990&message=Your%20otp%20is%202786&sender=senderid&otp=2786
```

|  Parameter name |  	Data type|  	Description|
|------------- |-----------------|-----------------|
|  authkey *	|  alphanumeric|  	Login authentication key (this key is unique for every user)
|  mobile *		|  integer		|  Keep number in international format (with country code)
|  message		|  varchar		|  Message content to send. (default : Your verification code is ##OTP##.)
|  sender		|  varchar		|  Receiver will see this as sender's ID. (default : OTPSMS)
|  otp 			|  	integer		|  OTP to send and verify. If not sent, OTP will be generated.
|  otp_expiry	|  integer		|  Expiry of OTP to verify, in minutes (default : 1 day, min : 1 minute)
|  otp_length	|  integer		|  Number of digits in OTP (default : 4, min : 4, max : 9)

# Sample Output

```sh
{"message":"3763646c3058373530393938","type":"success"}
```
### RESEND OTP
- `GET` Method
```sh
http://api.msg91.com/api/retryotp.php?authkey=YourAuthKey&mobile=919999999990&retrytype=voice
```
 | Parameter name	 | Data type | 	Description|
 | --------------    | --------- | ------------|
 | authkey *	 | alphanumeric | 	Login authentication key (this key is unique for every user)
 | mobile *	 	 | integer 		| 	Keep number in international format (with country code)
 | retrytype	 | varchar 		| 	Method to retry otp : voice or text. Default is voice.

Sample Output
```sh
{"message":"otp_sent_successfully","type":"success"}
```
### VERIFY OTP
- `GET` Method

```sh
http://api.msg91.com/api/verifyRequestOTP.php?authkey=YourAuthKey&mobile=919999999990&otp=2786
```
 | Parameter name |	Data type | Description|
 | -------------- | ----------| ------------|
 | authkey *	 | alphanumeric | 	Login authentication key (this key is unique for every user)
 | mobile *	 	 | integer	 	| Keep number in international format (with country code)
 | otp *	 	 | varchar	 	| OTP to verify

Sample Output
```sh
{"message":"number_verified_successfully","type":"success"}
```
