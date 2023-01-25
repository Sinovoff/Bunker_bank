<?header ("Expires: Mon, 01 Jan 1990 00:00:00 GMT");            // Date in the past
header ("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");		// always modified
header ("Cache-Control: no-cache, must-revalidate");            // HTTP/1.1
header ("Pragma: no-cache");                                    // HTTP/1.0

error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set("display_errors", 1);

//define('WEBPATH', '/var/www/html/bunkervalladolid.es/');
//define('WEBROOT', 'http://172.26.0.201/bunkervalladolid.es/');
//define('WEBROOTSEGURO', 'https://www.bunkervalladolid.es/');

define('WEBPATH', '/var/www/vhosts/bunkervalladolid.es/httpdocs/');
define('WEBROOT', 'http://www.bunkervalladolid.es/');
define('WEBROOTSEGURO', 'https://www.bunkervalladolid.es/');

define('IVAPOR', 21);
define('METAFINAL', " - The Bunker Escape Room");

require_once (WEBPATH."admin/ActiveRecord.php");

// initialize ActiveRecord
ActiveRecord\Config::initialize(function($cfg)
{
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

	// you can change the default connection with the below
	//$cfg->set_default_connection('production');
});
	

?>