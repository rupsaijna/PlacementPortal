
<?php
include "../sql.php";
include "../class_validate.php";
// $student = new validation($_GET['rno'],$_GET['rec']);
$student = new validation( '100905129' , '18' );
//echo $student->form_presence ;
if( $student->form_presence == 1 ){ 
 if( $student->validate_test() == True ){ 
	
	$sqll = "SELECT `form` FROM `form` WHERE `recid`=".'18' ; 
	$res = mysql_query( $sqll );
	while($row = mysql_fetch_array($res)){
		echo "<form method=\"post\" action=\"saveform.php\">";
		echo "<input type=\"hidden\" name=\"RegNo\" value=\"".$_GET['rno']."\" />";
		echo "<input type=\"hidden\" name=\"RecNo\" value=\"".$_GET['rec']."\" />";
		echo html_entity_decode($row['form'], ENT_NOQUOTES );
		echo "<input type=\"submit\" value=\"Save Details\" />";
		echo "</form>";
	}
	//echo "FORM"; 
 } else { 
	echo $student->validate('') ; 
	echo "please click here to go back to <a href=\"student_companies.php\">list of company</a>.";
 }
}

?>

