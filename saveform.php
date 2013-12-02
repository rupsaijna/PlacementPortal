<?php
include "sql.php";
include "class_validate.php";

include "class_security.php";
if (isset($_COOKIE["student"])){ 
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
	
	$secure = new security( $cookie , $_SERVER['REMOTE_ADDR'] , $fwd );

	if( $secure->status == 0 ){
			setcookie("student", "", time()-3600);
			$secure->delete();
			header("location:".$location."/index.php") ;
		}

		if( $secure->status == 1 ){
			$studentid = $secure->regno ;
		}


		if( $secure->status == 2 ){
			$val = $secure->create();
			//echo "started!";
			setcookie("student", $val , time()+3600) ;
			header("location:".$location."/student_companies.php") ;
		}

} else {
	header("location:".$location."/index.php") ;
}


$reg = $_POST["RegNo"];
$rec = $_POST["RecNo"];
foreach ($_POST as $key => $value) {
    $form_val[ $key ] = $value;
}


$student = new validation( $reg , $rec );

unset( $form_val["RegNo"] );
unset( $form_val["RecNo"] );
$form_val2 = json_encode($form_val) ;
$student->validate( $form_val2 );
echo $student->message ;
?>
<br/>
Please click here to go back to <a href="student_companies.php">list of company</a>.
