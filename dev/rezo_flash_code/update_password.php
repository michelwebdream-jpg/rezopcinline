<?PHP


header('Expires: Thu, 01 Jan 1970 00:00:00 GMT, -1');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');

/**************************************************************************/


// AUTOLOAD CLASS OBJECTS... YOU CAN USE INCLUDES IF YOU PREFER
if(!function_exists("__autoload")){ 
	function __autoload($class_name){
		require_once('classes/class_'.$class_name.'.php');
	}
}

// CREATE DATABASE OBJECT ( MAKE SURE TO CHANGE LOGIN INFO IN CLASS FILE )
$db = new DbConnect();
$db->show_errors();
$db->query("SET NAMES 'utf8'");

$mon_code=$_POST['mon_code'];
$mon_password_actuel=addslashes($_POST['mon_password_actuel']);
$mon_password_new=addslashes($_POST['mon_password_new']);
$pass=0;

$sql = "SELECT * FROM REZO_FLASH WHERE moncode='$mon_code' AND motdepasse='$mon_password_actuel';"; 
if($result = $db->query($sql))
{
    if($result->num_rows){
        while($row = $result->fetch_array(MYSQLI_ASSOC)){

            $pass=$pass+1;
        }
    }
}

if ($pass==1){
		
		$sql = "UPDATE REZO_FLASH SET motdepasse='".$mon_password_new."' WHERE moncode='$mon_code' AND motdepasse='$mon_password_actuel';";
		$db->query($sql);

		if($result = $db->query($sql))
        {
            echo "1";
        }else{
            echo "-1";
        }
	
}else{
	echo "-1";
}
?>