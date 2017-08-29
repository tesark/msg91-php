### SMS
 [Msg91 Send SMS](http://api.msg91.com/apidoc/textsms/send-sms.php) 
- `GET` Method
- `POST` Method
```sh
 GET
http://api.msg91.com/api/sendhttp.php?authkey=YourAuthKey&mobiles=919999999990,919999999999&message=message&sender=ABCDEF&route=4&country=0
````
```sh
 POST
 https://control.msg91.com/api/sendhttp.php
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
  - route=4 for transactional SMS

# Sample Output
```sh
5134842646923e183d000075
```
>Note : Output will be request Id which is alphanumeric and contains 24 character like mentioned above. With this request id, delivery report can be viewed. If request not sent successfully, you will get the appropriate error message. View error codes

### SEND OTP
[Msg91 Send OTP](http://api.msg91.com/apidoc/sendotp/send-otp.php)
- `GET` Method
- `POST` Method

```sh
GET
http://api.msg91.com/api/sendotp.php?authkey=YourAuthKey&mobile=919999999990&message=Your%20otp%20is%202786&sender=senderid&otp=2786
```

```sh
POST
https://sendotp.msg91.com/api/generateOTP
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

# Error Codes
### Missing parameters
| Error code | Description |
| ---------- | ------------- |
| 101		 | Missing mobile no.
| 102		 | Missing message
| 103	 	 | Missing sender ID
| 104		 | Missing username
| 105		 | Missing password
| 106		 | Missing Authentication Key
| 107		 | Missing Route
### Invalid parameters
| Error code |	Description|
| ---------- | ------------|
| 202		 | Invalid mobile number. You must have entered either less than 10 digits or there is an alphabetic character in the mobile number field in API.
| 203		 | Invalid sender ID. Your sender ID must be 6 characters, alphabetic.
| 207		 | Invalid authentication key. Crosscheck your authentication key from your account’s API section.
| 208		 | IP is blacklisted. We are getting SMS submission requests other than your whitelisted IP list.
### Error codes
| Error code | 	Description |
| ---------- | ------------|
| 205		 | This route is dedicated for high traffic. You should try with minimum 20 mobile numbers in each request
| 209		 | Default Route for dialplan not found
| 210		 | Route could not be determined
| 301		 | Insufficient balance to send SMS
| 302		 | Expired user account. You need to contact your account manager.
| 303		 | Banned user account
| 306		 | This route is currently unavailable. You can send SMS from this route only between 9 AM - 9 PM.
| 307		 | Incorrect scheduled time
| 308		 | Campaign name cannot be greater than 32 characters
| 309		 | Selected group(s) does not belong to you
| 310		 | SMS is too long. System paused this request automatically.
| 311		 | Request discarded because same request was generated twice within 10 seconds
| 418		 | IP is not whitelisted
| 505		 | Your account is a demo account. Please contact support for details
| 506		 | Small campaign limit exceeded. (only 20 campaigns of less than 100 SMS in 24 hours can be sent, exceeding it will show the error)
### System errors
| Error code| 	Description |
| ---------- | ------------|
| 001		 | Unable to connect database
| 002		 | Unable to select database
| 601		 | Internal error.Please contact support for details