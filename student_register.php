
<?php
include "sql.php";

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

include "class_validate.php";
// $student = new validation($_GET['rno'],$_GET['rec']);
$student = new validation( $studentid , $_GET['rec'] );
//echo $student->form_presence ;
if( $student->form_presence == 1 ){ 
 if( $student->validate_test() == True ){ 
	
	$sqll = "SELECT `form` FROM `form` WHERE `RecId`=".$_GET['rec'] ; 
	$res = mysql_query( $sqll );
	while($row = mysql_fetch_array($res)){
		echo "<form method=\"post\" action=\"saveform.php\">";
		echo "<input type=\"hidden\" name=\"RegNo\" value=\"".$_GET['rno']."\" />";
		echo "<input type=\"hidden\" name=\"RecNo\" value=\"".$_GET['rec']."\" />";
		$form = str_replace("&quot;", "\"", $row['form']);
		echo html_entity_decode($form , ENT_NOQUOTES );
		echo "<br/><input type=\"submit\" value=\"Save Details\" />";
		echo "</form>";
	}
	//echo "FORM"; 
 } else { 
	$student->validate('') ; 
	echo $student->message ;
	echo "<br/>please click here to go back to <a href=\"student_companies.php\">list of company</a>.";
 }
} else {
	$student->validate('') ; 
	echo $student->message ;
	echo "<br/>please click here to go back to <a href=\"student_companies.php\">list of company</a>.";
}

?>

