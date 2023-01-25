<?session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set("display_errors", 1);

if (!$_SESSION['UID']) {
    $_SESSION['UID'] = md5(uniqid(ID));
}


//$WEBROOT="http://172.26.0.201/bunkervalladolid.com/";	
//$WEBROOTSEGURO = "https://172.26.0.201/bunkervalladolid.com/";	
$WEBROOT="http://www.bunkervalladolid.es/";	
$WEBROOTSEGURO="https://www.bunkervalladolid.es/";	

//define('WEBPATH', '/var/www/html/bunkervalladolid.com/');
define('WEBPATH', '/var/www/vhosts/bunkervalladolid.es/httpdocs/');

define('METAFINAL', " - The Bunker Escape Room");

// initialize ActiveRecord
require_once (WEBPATH."admin/ActiveRecord.php");

ActiveRecord\Config::initialize(function($cfg){

	/*$DBHost="172.26.0.201";
	$DBName="bunkervalladolid_com";
	$DBUser="salva";
	$DBPass="salva";*/

	$DBHost="localhost";
	$DBName="bunkervalladolid_es";
	$DBUser="bunkervalladolid";
	$DBPass="Escapebunker17";

	$cfg->set_model_directory(WEBPATH.'/admin/modelos');
	$cfg->set_connections(array('development' =>
			'mysql://'.$DBUser.
			':'.$DBPass.
			'@'.$DBHost.
			'/'.$DBName));
});

?>