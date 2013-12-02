<?PHP
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
?>

<?php include("template/header.php") ; ?>

<?php include("template/nav_stu.php") ; ?>


<div class="dp100" style="">


<?php
echo "<table width=\"100%\"><thead><tr><td width=\"25%\">Company Name</td><td width=\"75%\">Actions</td></tr></thead>" ;

$result = mysql_query("SELECT `recruitments`.`CompanyName`, `recruitments`.`RecId`, `recruitments`.`Status` , `students`.`RegNo` , `students`.`rstuid` from `recruitments`, `students` where `recruitments`.`RecId` = `students`.`RecId` and `students`.`RegNo` = ". $studentid ." ORDER by `students`.`RecId`" );

$no_rows = mysql_num_rows( $result );
	if( $no_rows == 0 ){			
		echo "";
	} else {
		while($row = mysql_fetch_array($result)){
			echo "<tr>" ;
			if ( $row['Status'] == "2" ) { 
				echo "<td><s>".$row['CompanyName']."</s></td>" ; } 
			else { 
				echo '<td>'.$row['CompanyName'].'</td>' ; }
			if ( $row['Status'] == "0" ) { 
				echo "<td><a href=\"deregister.php?r=".$row["rstuid"]."\">Deregister</a>".'</td>' ; } 
			echo "</tr>" ;
	
		}

	}


echo "</table>" ;

?>

<p style="font-size:14px; font-family:arial;">
Note : The Companies struck out are the ones which are already over.<br/>
The companies which have a '<em>deregister</em>' action are still open to registration and deregisration.<br/>
The companies which dont have an action associated with them, The registration/deregistration has stopped.<br/>
If you need to register or deregister, please contact the placement office directly.
</p>

</div>

<?php include("template/footer.php") ; ?>
