<?require_once ("../init.php");

$_registro = $_POST['modelo']::find($_POST['id']);

if ($_registro->{$_POST['campo']}==1)	$_registro->{$_POST['campo']}=0;
else									$_registro->{$_POST['campo']}=1;
$_registro->save();


echo $_registro->{$_POST['campo']};
?>