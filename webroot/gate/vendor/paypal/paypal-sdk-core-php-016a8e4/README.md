# PayPal Core SDK - V1.5.4

## POODLE UPDATE

- Because of the Poodle vulnerability, PayPal has disabled SSLv3.
- To enable TLS encryption, the change was made to PPHttpConfig.php to use a cipher list specific to TLS encryption.
``` php
    /**
	 * Some default options for curl
	 * These are typically overridden by PPConnectionManager
	 */
	public static $DEFAULT_CURL_OPTS = array(
		CURLOPT_SSLVERSION => 1,
		CURLOPT_CONNECTTIMEOUT => 10,
		CURLOPT_RETURNTRANSFER => TRUE,
		CURLOPT_TIMEOUT        => 60,	// maximum number of seconds to allow cURL functions to execute
		CURLOPT_USERAGENT      => 'PayPal-PHP-SDK',
		CURLOPT_HTTPHEADER     => array(),
		CURLOPT_SSL_VERIFYHOST => 2,
		CURLOPT_SSL_VERIFYPEER => 1,
		CURLOPT_SSL_CIPHER_LIST => 'TLSv1',
	);
```
- There are two primary changes done to curl options:
    - CURLOPT_SSLVERSION is set to 1 . See [here](http://curl.haxx.se/libcurl/c/CURLOPT_SSLVERSION.html) for more information
    - CURLOPT_SSL_CIPHER_LIST was set to TLSv1, See [here](http://curl.haxx.se/libcurl/c/CURLOPT_SSL_CIPHER_LIST.html) for more information

All these changes are included in the recent [release](https://github.com/paypal/sdk-core-php/releases), along with many other bug fixes. We highly encourage you to update your versions, by either using `composer` or directly downloading the library available [here](https://github.com/paypal/sdk-core-php/releases).

## Prerequisites

 * PHP 5.2 and above
 * curl extension with support for OpenSSL
 * PHPUnit 3.5 for running test suite (Optional)
 * Composer (Optional - for running test cases)

## Configuration
  
 
## OpenID Connect Integration

   1. Redirect your buyer to `PPOpenIdSession::getAuthorizationUrl($redirectUri, array('openid', 'address'));` to obtain authorization. The second argument is the list of access privileges that you want from the buyer.
   2. Capture the authorization code that is available as a query parameter (`code`) in the redirect url
   3. Exchange the authorization code for a access token, refresh token, id token combo


```php
    $token = PPOpenIdTokeninfo::createFromAuthorizationCode(
		array(
			'code' => $authCode
		)
	);
```
   4. The access token is valid for a predefined duration and can be used for seamless XO or for retrieving user information
 

```php
   $user = PPOpenIdUserinfo::getUserinfo(
		array(
			'access_token' => $token->getAccessToken()
		)	
	);
```
   5. If the access token has expired, you can obtain a new access token using the refresh token from the 3'rd step.

```php
   $token->createFromRefreshToken(array('openid', 'address'));
```
   6. Redirect your buyer to `PPOpenIdSession::getLogoutUrl($redirectUri, $idToken);` to log him out of paypal. 
