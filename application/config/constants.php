<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESCTRUCTIVE') OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/*
|--------------------------------------------------------------------------
| Custom Constants (added by CI Bootstrap)
|--------------------------------------------------------------------------
| Constants to be used in both Frontend and other modules
|
*/
if (!(PHP_SAPI === 'cli' OR defined('STDIN')))
{
	// Base URL with directory support
	$protocol = (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS'])!== 'off') ? 'https' : 'http';
	$base_url = $protocol.'://'.$_SERVER['HTTP_HOST'];
	$base_url.= dirname($_SERVER['SCRIPT_NAME']);
	define('BASE_URL', $base_url);
	
	// For API prefix in Swagger annotation (/application/modules/api/swagger/info.php)
	define('API_PROTOCOL', $protocol);
	define('API_HOST', $_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME']));
}

define('CI_BOOTSTRAP_REPO',			'#');
define('CI_BOOTSTRAP_VERSION',		'Build 2017');	// will follow semantic version (e.g. v1.x.x) after first stable launch

// Upload paths
define('ASSETS_PATH', $_SERVER['DOCUMENT_ROOT'].'/api/assets/' );

define('UPLOAD_BLOG_POST',		'assets/admin/images/blog_banner');

// define("CI_CURRENCY_SYMBOL", "KD");
// define("CI_CURRENCY_CODE", "KD");
// define("STORE_TYPE", "KWT");
// define("BRANCH_ID", "8");

/*function get_store_type(){
// 	return array( "store_type" => STORE_TYPE );
return array( );
}*/

function store_push($a){
// return array_merge($a,get_store_type());
return $a;

}
function get_percentage($sale_price,$price){
	if($price  > $sale_price ){
		return round( ( ( $price - $sale_price ) / $price ) * 100 );
	}else{
		return 0;
	}
	
}


function send_email($emails,$subject,$message,$includes = true){
	if(!empty($message)){
		if($includes){
			$header = email_header();
			$footer = email_footer();
			$message = $header.$message.$footer;
		}
		
		$headers = "From: accounts@myunilifeapp.com\r\n";
        $headers .= "Reply-To: accounts@myunilifeapp.com\r\n";
        $headers .= "CC: accounts@myunilifeapp.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
		$headers .= "X-Mailer: PHP/" . phpversion();
		
		return @mail($emails, $subject, $message, $headers);
	}
}


function email_header(){
	$template = '<table cellspacing="0" cellpadding="5" width="100%" bgcolor="#f3f1ed">
					    <tbody>
					    <tr>
					        <td width="1000" style="padding-top:20px;">
					            <div style="max-width:560px;min-width:300px;margin:0 auto;">
					                <table cellspacing="1" cellpadding="0" width="100%" bgcolor="#e5e5e5" style="border-collapse:separate;">
					                    <tbody>
					                    <tr>
					                        <td bgcolor="white">
					                            <table cellspacing="0" cellpadding="0" width="100%">
					                                <tbody>
					                                <tr>
					                                    <td align="center" valign="middle"
					                                        style="padding: 20px 0 20px 40px; background: #a78f8f;">
					                                        <img height="80" src="http://15.206.103.14/api/assets/frontend/images/unilife-icon.png">
					                                    </td>
					                                </tr>
					                                </tbody>
					                            </table>
					                        </td>
					                    </tr>
					                    <tr>
					                    <td bgcolor="white" style="padding:25px;">';
	return $template;
}

function email_footer(){
	$template = ' 
					                        </td>
					                    </tr>
					                    </tbody>
					                </table>
					            </div>
					        </td>
					        
					    </tr>
					    <tr>
					       
					        <td>
					            <div style="max-width:560px;margin:0 auto;">
					                <table cellspacing="0" cellpadding="0" align="right"
					                       style="font:12px/15px Arial,sans-serif;color:#999999;margin:0 0 20px 20px;">
					                    <tbody>
					                    <tr>
					                        <td align="right">
					                            <div>&copy; Unilife</div>
					                        </td>
					                    </tr>
					                    </tbody>
					                </table>
					                <div style="font:12px/15px Arial,sans-serif;color:#999999;">
					                    <div style="margin-bottom:1em;">This&nbsp;is&nbsp;an automatically&nbsp;generated&nbsp;mail, please&nbsp;do&nbsp;not&nbsp;reply.</div>
					                </div>
					            </div>
					        </td>
					       
					    </tr>
					    </tbody>
					</table>';
	return $template;
}


function send_email_using_postmark($emails,$subject,$message,$includes = true)
{
	// echo "<pre>";
	// print_r($emails);
	if(!empty($message))
	{
		if($includes)
		{
			$header = email_header();
			$footer = email_footer();
			$message = $header.$message.$footer;
		}
		// echo "<pre>";
		// print_r($message);
		// die;
	

		$result = array();

		// Pass the customer's authorisation code, email and amount
		$postdata =  
		array(
			'From' 		=> 'accounts@myunilifeapp.com',
			'To' 		=> $emails,
			'Cc'		=> "",
			'Bcc'		=> "blank-copied@example.com",
			'Tag'		=> "Invitation",
			'ReplyTo'	=> "reply@example.com",
			'Subject' 	=> $subject, 
			'HtmlBody' 	=> $message
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"https://api.postmarkapp.com/email");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($postdata));  //Post Fields
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$headers = [
		  'accept: application/json',
		  'content-type: application/json',
		  'cache-control: no-cache',
		  'postman-token: 5f075362-8c76-4049-bcf9-857c35136b09',
		  'x-postmark-server-token: 5f075362-8c76-4049-bcf9-857c35136b09',
		];

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$request = curl_exec ($ch);
		// echo $request;
		if(curl_error($ch))
		{
			echo 'error:' . curl_error($ch);
		}

		curl_close ($ch);
		if ($request)
		{
			$result = json_decode($request, true);
		}

	

		// echo "<pre>";
		// print_r($result);
		// die;
	}
}

function forgetpass_content($name,$link,$password = '',$username = '')
{

	$message = "<p style='font-size: 12px;'>Hi $name,</p>
				<br/><p style='font-size: 12px; color:#696969; margin-top: -15px;'>
				We've received a request to reset your password. If you didn't make the request,
				just ignore this email. Otherwise, you can reset your password using this link.</p>

				<p style='font-size: 12px; color:#696969; margin-top: -15px;'>
				<br/>
				just ignore this email. Otherwise, you can reset your password using this link.</p><br/>


			<a href='".$link."' style='margin-left: 104px; margin-top: 20px; width: 100% !important;padding: 10px 0px;background: #3c4043;border: none;color: #fff;font-size: 14px;text-transform: uppercase;text-decoration: none;border-radius: 3px;margin: 15px 0 15px 0; cursor: pointer;clear: both; overflow: hidden;margin: auto;display: inline-block;font-weight: 500;text-align: center;'>Reset Password</a>";
	return $message;
}

function send_email_using_sendinblue($emails,$subject,$message,$includes = true)
{
	// echo "<pre>";
	// print_r($emails);
	if(!empty($message))
	{
		if($includes)
		{
			// $header = email_header();
			// $footer = email_footer();
			// $message = $header.$message.$footer;
		}

		$result = array();
		// Pass the customer's authorisation code, email and amount

		$postdata =  array (
						  'sender' => 
						  array (
						    'name' => 'City center',
						    'email' => 'girishbhumkar5@gmail.com',
						  ),
						  'to' => 
						  array (
						    0 => 
						    array (
						      'email' => $emails,
						      'name' => 'Girish Bhumkar',
						    ),
						  ),
						  'subject' 	=> $subject,
						  'htmlContent' => $message,
						  'headers' => 
						  array (
						    'X-Mailin-custom' => 'custom_header_1:custom_value_1|custom_header_2:custom_value_2|custom_header_3:custom_value_3',
						    'charset' => 'iso-8859-1',
						  ),
						);


		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"https://api.sendinblue.com/v3/smtp/email");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($postdata));  //Post Fields
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$headers = [
		'api-key: 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',
		'Content-Type: application/json',
		'accept: application/json',
		'Postman-Token: f161f461-9f42-1728-f459-68f1d77e88e5',
		];

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$request = curl_exec ($ch);
		// echo $request;
		if(curl_error($ch)){
			echo 'error:' . curl_error($ch);
		}

		curl_close ($ch);
		if ($request) {
			$result = json_decode($request, true);
		}

	

		// echo "<pre>";
		// print_r($result);
		// die;
	}
}

/**
 * Encrypt and decrypt
 * @param string $string string to be encrypted/decrypted
 * @param string $action what to do with this? e for encrypt, d for decrypt
 */

function en_de_crypt( $string, $action = 'e' ) {
    $secret_key = 'a1s3er1n5n7m3f3e45o5p9w3k2x3q32x';
    $secret_iv = 'a1snsd5nm3fssddsdgrkjlpdf9llkw22x';
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
    if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }
    else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }
    return $output;
}

function getLocationInfoByIp(){

    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = @$_SERVER['REMOTE_ADDR'];
    $result  = array('country'=>'', 'city'=>'');
    if(filter_var($client, FILTER_VALIDATE_IP)){
        $ip = $client;
    }elseif(filter_var($forward, FILTER_VALIDATE_IP)){
        $ip = $forward;
    }else{
        $ip = $remote;
    }
    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));    
    if($ip_data && $ip_data->geoplugin_countryName != null){
        $result['country'] = $ip_data->geoplugin_countryName;
        $result['country_code'] = $ip_data->geoplugin_countryCode;
        $result['city'] = $ip_data->geoplugin_city;
    }
    return $result;
}

function decnum($number){
	$number = round($number,2);
	return number_format((float)$number, 2, '.', '');
}