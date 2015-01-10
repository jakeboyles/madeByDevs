<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*!
* HybridAuth
* http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
* (c) 2009-2012, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
*/
// ----------------------------------------------------------------------------------------
// HybridAuth Config file: http://hybridauth.sourceforge.net/userguide/Configuration.html
// ----------------------------------------------------------------------------------------

$config =
array(
// set on "base_url" the relative url that point to HybridAuth Endpoint
'base_url' => base_url().'index.php/hauth/endpoint',
"providers" => array (
// openid providers
"OpenID" => array (
"enabled" => true
),
"Yahoo" => array (
"enabled" => true,
"keys" => array ( "id" => "", "secret" => "" ),
),
"AOL" => array (
"enabled" => true
),
"Google" => array (
"enabled" => true,
"keys" => array ( "id" => "", "secret" => "" ),
),
"Facebook" => array (
"enabled" => true,
"keys" => array ( "id" => "1582433231972725", "secret" => "e1fa2f325cfd6bf04c045f13f945b226" ),
),
"Twitter" => array (
"enabled" => true,
"keys" => array ( "key" => "SbEJVvodcbHR3TY5mylCBAnHJ", "secret" => "N1bQaozZB3KWJDkQVkNYJjPKRHpKONjo88OllvkqszZhzB4yee" )
),
"GitHub" => array (
"enabled" => true,
"keys" => array ( "key" => "a76469204666230933ff", "secret" => "30cf5974be28f4e5dc5b9a0d8eaf10ae9956e2b5" )
),
// windows live
"Live" => array (
"enabled" => true,
"keys" => array ( "id" => "", "secret" => "" )
),
"MySpace" => array (
"enabled" => true,
"keys" => array ( "key" => "", "secret" => "" )
),
"LinkedIn" => array (
"enabled" => true,
"keys" => array ( "key" => "", "secret" => "" )
),
"Foursquare" => array (
"enabled" => true,
"keys" => array ( "id" => "", "secret" => "" )
),
),
// if you want to enable logging, set 'debug_mode' to true then provide a writable file by the web server on "debug_file"
"debug_mode" => (ENVIRONMENT == 'development'),
"debug_file" => APPPATH.'/logs/hybridauth.log',
);
/* End of file hybridauthlib.php */
/* Location: ./application/config/hybridauthlib.php */