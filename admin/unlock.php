<?PHP
include "../sql.php";
if (!isset($_COOKIE["admin"])){ header("location:".$location."/admin/index.php"); }

$r = $_GET['r'];
$s = $_GET['s'];


function return_tablename($id){
		
		$stubranch = $id[4].$id[5] ;
		//$stubranch = $id ;
		
		if ( in_array( $stubranch , array(34,33,02,04,24,03,05,06,07,21,08,11,09,29,10) ) ){ return "be"; }
		if ( in_array( $stubranch[1] , array(8,9) ) && $stubranch<10){ return "be"; }
		if ( in_array( $stubranch , array(12,46,49,50,18,14,13,48,15,42,43,16,44,25,27,28,22,17,26,30,45,19) ) ){return "mt" ;}
		
}
$r = (string) $r ;
if( strlen( $r ) == 8 ){ $r = "0".$r ; }
$table = return_tablename($r) ; //echo $table ;

switch( $s ){
  case "c":
	mysql_query(" UPDATE `".$table."_student_details` SET `allowed_core` = '0' WHERE `RegNo` =". $r ."  ; ");
	break ;
  case "i":
	mysql_query(" UPDATE `".$table."_student_details` SET `allowed_internship` = '0' WHERE `RegNo` =". $r ."  ; ");
	break ;	
  case "a":
	mysql_query(" UPDATE `".$table."_student_details` SET `allowed_all` = '0' WHERE `RegNo` =". $r ."  ; ");
	break ;	
  case "p":
	mysql_query(" UPDATE `".$table."_student_details` SET `allowed_pc` = '0' WHERE `RegNo` =". $r ."  ; ");
	break ;
}

header("location:".$location."/admin/student.php?r=".$r);
?>

