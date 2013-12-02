<?PHP
include "../sql.php";
if (!isset($_COOKIE["admin"])){ header("location:".$location."/admin/index.php"); }

if( isset( $selected ) ){ $selected = $_POST["selected"] ; } else { $selected = array(); }
if( isset( $pc ) ){ $pc = $_POST["pc"] ; } else { $pc = array(); }

$msg = "" ;
$rid = $_GET["r"] ;
$sqll = "SELECT `type` FROM `recruitments`  WHERE `recid` =".$rid ;
//echo $sqll;
$res = mysql_query( $sqll );
while($row = mysql_fetch_array($res)){
	$type = $row['type'];
}

//echo count($selected)."<br/><table>" ;

function return_tablename($id){
		
		$stubranch = $id[4].$id[5] ;
		//$stubranch = $id ;
		
		if ( in_array( $stubranch , array(34,33,02,04,24,03,05,06,07,21,08,11,09,29,10) ) ){ return "be"; }

		if ( in_array( $stubranch , array(12,46,49,50,18,14,13,48,15,42,43,16,44,25,27,28,22,17,26,30,45,19) ) ){return "mt" ;}
		
}


if( sizeof($selected) > 0 ){
foreach ( $selected as $value)
{
	mysql_query("UPDATE `students` SET `selected` = '1' WHERE `rstuid` =".$value);	
	
	$sqll = "SELECT `RegNo`,`type` FROM `students`  WHERE `rstuid` =".$value ; //echo $sqll;
	$res = mysql_query( $sqll );
	while($row = mysql_fetch_array($res)){
		$regno = $row['RegNo'];
		$type = $row['type'];
	}
	
	$tbl = return_tablename($regno) ;

	$res = mysql_query("SELECT `Name` FROM `".$tbl."_student_details`  WHERE `RegNo` =".$regno );
	while($row = mysql_fetch_array($res)){
		$Name = $row['Name'];
	}
	
	
	if( $type == "c" ){
		mysql_query("UPDATE `".$tbl."_student_details` SET `allowed_core` = '1' WHERE `RegNo` =".$regno);
	}

	if( $type == "i" ){
		mysql_query("UPDATE `".$tbl."_student_details` SET `allowed_internship` = '1' WHERE `RegNo` =".$regno);
	}

	echo "<tr><td>".$Name."</td><td>".$regno."</td><td><a href=\"setpc.php?r=".$regno."\">Set PC</a></td></tr>" ;
	
	mysql_query("DELETE FROM `students` WHERE `type`='".$type."' and `rstuid` != ".$value." and `RegNo` = '".$regno."'");
	
}
} else { $msg .= "<br/>None selected in form to save. Click <a href=\"".$location."/admin/students.php?r=".$_GET["r"]."\">here</a> to go back." ; }

if( sizeof($pc) > 0 ){
foreach ( $pc as $value)
{
	
	$sqll = "SELECT `RegNo` FROM `students`  WHERE `rstuid` =".$value ; //echo $sqll;
	$res = mysql_query( $sqll );
	while($row = mysql_fetch_array($res)){
		$regno = $row['RegNo'];
	}
	
	$tbl = return_tablename($regno) ;	
	
	mysql_query("UPDATE `".$tbl."_student_details` SET `allowed_pc` = 1 WHERE `RegNo` =".$regno);
	
}
} else { $msg .= "<br/>None selected in form to Block PC. Click <a href=\"".$location."/admin/students.php?r=".$_GET["r"]."\">here</a> to go back." ; }
	
	

if( $msg == "" ){ header( "location:".$location."/admin/students.php?r=".$_GET["r"] ); }
else {
	include("template/header.php") ; 
	include("template/nav.php") ;
	echo $msg ;
	include("template/footer.php") ;
}



?>
