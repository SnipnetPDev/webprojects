<?php
/**
 * config.php
 *
 * App Configuration
 *
 * @Framework  BuildPHP
 * @author     Snipnet Technologies
 * @license    MIT
 * @version    1.0
 * @since      File available since Release 1.0
 * @copyright  2020 Snipnet Technologies
 */
 
//ERROR CONFIGURATION
error_reporting(0);
ini_set('display_errors', 0);

/* App credentials. */
define('APP_URL', 'http://localhost/loan/web/');
define('APP_LEVEL', 'release'); //debug (while working on localhost), release (for a live website)

/* Database credentials. */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'loan');

/* SMTP credentials. */
define('SMTP_HOST', 'SMTP_HOST');
define('SMTP_PORT', 'SMTP_PORT');
define('SMTP_USER', 'SMTP_USERNAME');
define('SMTP_PASS', 'SMTP_PASSWORD');

/* SMS credentials. */
// PROVIDER: https://africastalking.com/
// Contact snipnettech@gmail.com for SMS API if africastalking.com becomes too complicated
define('KEY0', 'qbills');
define('KEY1', 'a72f750074b048c80670853a60d701884483f782b1f728fcac7c420d78ee85d5');
define('KEY2', 'Snipnet');

//App Manifest
$project_manifest = json_decode(file_get_contents(APP_URL.'manifest.json'));
define('APP_NAME', $project_manifest->name);
define('APP_DESC', $project_manifest->description);
define('APP_TROUTE', $project_manifest->tempFolder);
define('APP_LICENSE', $project_manifest->license);
define('APP_AUTHOR', '<'.$project_manifest->author->name.':'.$project_manifest->author->email.'>');
$theme_manifest = json_decode(file_get_contents(APP_URL.APP_TROUTE.'manifest.json'));
define('APP_THEME', $theme_manifest->template);
define('APP_THEME_EXT', $theme_manifest->fileExt);
define('APP_INDEX', $theme_manifest->homepage);
$template_manifest = json_decode(file_get_contents(APP_URL.APP_TROUTE.APP_THEME.'/manifest.json'));

//Database Connection
try{
    $db = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}

	class DB{
		public $connect;
		private $host = DB_SERVER;
		private $userName = DB_USERNAME;
		private $userPass = DB_PASSWORD;
		private $BDName   = DB_NAME; 

		public function __construct(){
			$this->BDConnect();
		}

		public function BDConnect(){
			$this->connect = mysqli_connect($this->host,$this->userName,$this->userPass,$this->BDName);
		}
		public function query_execute($sql){
			return mysqli_query($this->connect,$sql);
		}
		public function query_rowCount($sql){
			return mysqli_num_rows($sql);
		}
		public function query_lastID(){
			return mysqli_insert_id($this->connect);
		}

	}

//Class Autoload
$ddos_autoload = 'vendor/anti-ddos-lite/anti-ddos-lite.php';
$ddos_autoload2 = '../vendor/anti-ddos-lite/anti-ddos-lite.php';
$ddos_autoload3 = '../../vendor/anti-ddos-lite/anti-ddos-lite.php';
   if ( file_exists($ddos_autoload)) {
	  require_once $ddos_autoload;
	  
   }elseif ( file_exists($ddos_autoload2)) {
	  require_once $ddos_autoload2;
	  
   }elseif ( file_exists($ddos_autoload3)) {
	  require_once $ddos_autoload3;
	  
   }
   
   
$vendor_autoload = 'vendor/autoload.php';
$vendor_autoload2 = '../vendor/autoload.php';
$vendor_autoload3 = '../../vendor/autoload.php';
   if ( file_exists($vendor_autoload)) {
	  require_once $vendor_autoload;
	  
   }elseif ( file_exists($vendor_autoload2)) {
	  require_once $vendor_autoload2;
	  
   }elseif ( file_exists($vendor_autoload3)) {
	  require_once $vendor_autoload3;
	  
   }

//Initiate Database connection Class
$dbObj = new DB();


//Initiate APP Class
$app = new Classes\APP;
// USAGE
// DATE & TIME
// $app->get_date_time('date'); return 2020-02-21
// $app->get_date_time('time'); return 10:13:12
// $app->get_date_time('dateTime'); 2020-02-21 10:13:12

// GET, POST, REQUEST Check
// $app->checkParameter($_POST['parm'], 'number'); Check if value is a number
// $app->checkParameter($_POST['parm'], 'string'); Check if value is a string
// $app->checkParameter($_POST['parm'], 'boolean'); Check if value is boolean (true or false)

//DOMAIN PATH
// $app->getDomain('https://example.com/whatever.php');

// DATA ENCRYPTION / DESCRIPTION
//our data to be encoded
//$password_plain = 'abc123';
//our key to encode data
//$key = 'abcdfghxxdg';
//our data being encrypted. This encrypted data will probably be going into a database
//since it's base64 encoded, it can go straight into a varchar or text database field without corruption worry
//$password_encrypted = $app->my_encrypt($password_plain, $key);
//echo $password_encrypted . "<br>";
//now we turn our encrypted data back to plain text
//$password_decrypted = $app->my_decrypt($password_encrypted, $key);
//echo $password_decrypted . "<br>";

//GET FILE SIZE
// $app->formatSizeUnits($bytes); output(KB, MB, GB, Bytes)

//GET RANDOM STRING
//Letters:
//$str = $app->get_rand_letters(8); // Only Letters
//Numbers:
//$str = $app->get_rand_numbers(8); // Only Numbers
//AlphaNumeric:
//$str = $app->get_rand_alphanumeric(8); // Numbers and Letters

//GET RANDOM PASSWORD
//$pass = $app->random_password();

//CONVERT STRING TO LINK
//$link = $app->slug($text);

//UPLOAD FILES
// $app->upload(['jpg', 'jpeg', 'png', 'gif', 'pdf', 'docx'], 'images/avatar/', 'avatar_file', 'raw');
// $app->upload(['jpg', 'jpeg', 'png', 'gif', 'svg'], 'images/avatar/', 'avatar_file', 'base64');

// GENERATE PDF FROM TEXT OR HTML
// $app->GetPDF('<h1>hello</h1>', $folder, $name);

// GET UNIQUE INDETIFIER FOR VISITOR
// $app->getWhois();


//Initiate Database Class v2
$mysqli = new Classes\DATABASE;
// mysqli USAGE
//INSERT
//$mysqli->insertInto('tableOne',array('name' => 'lolo' , 'deg' => '100')); //return string
//SELECT
//Single Select
//$mysqli->singleSelect('accounts',array('id' => '60' , 'mobile' => '+2348023775657'), 'fetch', array('ORDER BY' => 'rand()' , 'LIMIT' => '3')); //return array
//$mysqli->singleSelect('accounts',array('id' => '60' , 'mobile' => '+2348023775657'), 'count', array('ORDER BY' => 'rand()' , 'LIMIT' => '3')); //return string
//multi Select
//$mysqli->multiSelect(array('accounts' => 'a' , 'bvn' => 'b'),array('a.id' => '60' , 'b.usrID' => '60'), 'fetch', array('ORDER BY' => 'rand()' , 'LIMIT' => '3'));// return array
//$mysqli->multiSelect(array('accounts' => 'a' , 'bvn' => 'b'),array('a.id' => '60' , 'b.usrID' => '60'), 'count', array('ORDER BY' => 'rand()' , 'LIMIT' => '3')); //return string


//Initiate CUSTOM Class
$custom = new Classes\CUSTOM;
// USAGE
// $custom->helloWorld();

//Send SMS message
// $custom->sendSMS($recipients, $message, KEY0, KEY1, APP_NAME);


//Initiate Jenssegers platform detect Class
use Jenssegers\Agent\Agent;
$agent = new Agent();
//usage
//Check for Desktop device:
//$agent->isDesktop();
//Check for mobile device:
//$agent->isMobile();
//$agent->isTablet();
//$agent->isPhone();
//Check for operating system:
//$agent->isAndroidOS();
//$agent->is('iPhone');
//$agent->is('Windows');
//AUTO DETECT
//$platform = $agent->platform();
//Device Name:
//$device = $agent->device();
//Browser Name:
//$browser = $agent->browser();
//Robot detection
//$agent->isRobot();
//$robot = $agent->robot();
//Browser/platform version
//$browser = $agent->browser();
//$version = $agent->version($browser);
//$platform = $agent->platform();
//$version = $agent->version($platform);


//Initiate IP detect Class
use YogeshKoli\UserIP\UserIP;
//USAGE
// Get IP
//echo UserIP::get();
//Validated Given IP Address
//use YogeshKoli\UserIP\UserIP;
//$ip = '192.168.10.1';
//var_dump(UserIP::validate($ip));
//Output:
///example/ValidateIPTest.php:9:boolean true


//Initiate csrfhandler Class
//USAGE
// Send request
// use csrfhandler\csrf as csrf;
// echo csrf::token(); using id="_token" or name="_token"
// Validate request
// use csrfhandler\csrf as csrf;
//$isValid = csrf::post(); (all(),post(),post() methods allowed)
//if($isValid){
//	csrf::flushToken();
// DO Stuffs
//}else{
//	echo 'Invalid Access token';
//}

//CRSF security configuration
if(!isset($_SESSION['X-CSRF-TOKEN-LIST'])){
	session_start();
}
define('APP_KEY', $app->get_rand_alphanumeric(24));
$keyList = unserialize($_SESSION['X-AUTH-TOKEN-LIST']);
if (!is_array($keyList))
{
	$keyList = array();
}
array_push($keyList, APP_KEY);
$_SESSION['X-AUTH-TOKEN-LIST'] = serialize($keyList);


//VALIDATE SSL CERTIFICATE
//use Spatie\SslCertificate\SslCertificate;
//USAGE
//$certificate = SslCertificate::createForHostName('spatie.be');
//$certificate->getIssuer(); // returns "Let's Encrypt Authority X3"
//$certificate->isValid(); // returns true if the certificate is currently valid
//$certificate->expirationDate(); // returns an instance of Carbon
//$certificate->expirationDate()->diffInDays(); // returns an int
//$certificate->getSignatureAlgorithm(); // returns a string

$appConfig = $mysqli->singleSelect('config', '', 'fetch', '');
$cont = $mysqli->singleSelect('pages', '', 'fetch', '');
?>