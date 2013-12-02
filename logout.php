<?PHP
include 'sql.php';
include "class_security.php";
setcookie("student", "", time()-3600);
if( !isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ){ 
	$fwd = ""; 
} 
else { 
	$fwd = $_SERVER['HTTP_X_FORWARDED_FOR'] ; 
}
if( !isset( $_COOKIE["student"] ) ){ 
	$cookie = ""; 
} 
else { 
	$cookie = $_COOKIE["student"] ; 
}
		echo "cookie = ".$cookie."<br/>" ;
$secure = new security( $cookie , $_SERVER['REMOTE_ADDR'] , $fwd );
$secure->delete();
header("location:".$location."/index.php") ;
?>
