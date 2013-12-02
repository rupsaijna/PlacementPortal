<?PHP
include "sql.php";
include 'class_security.php';
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
<h3> If you think you are not seeing what should be here, try pressing f5</h3>
<h1><font color="green"><a href="delloite.php">Delloite Shortlist</a></font>
<h1><font color="green"><a href="mnm.php">Mahindra and Mahindra Shortlist</a></font>
<h1><font color="red">UPDATE : CISCO - no events on 19th August. Test begins 20th August,10AM sharp, Library Hall, Placement Dept.</h1><h3>No latecomers please.</h3></font>

<div class="dp100" style="">
<h4>List of companies open for registration</h4>
<?php


$result = mysql_query("SELECT `HTML`,`RecId` FROM `recruitments` WHERE `Status`=0");

while($row = mysql_fetch_array($result))
  {
	echo $row['HTML'] ;
	echo "<br>" ;
	echo "<a href=\"student_register.php?rno=".$studentid."&rec=".$row['RecId']."\">Register</a>" ;
	echo "<br>" ;
	echo "<hr/>" ;
	
}

$result = mysql_query("SELECT `HTML`,`RecId` FROM `recruitments` WHERE `Status`=1");
while($row = mysql_fetch_array($result))
  {
	echo $row['HTML'] ;
	echo "<br>" ;
	echo "<hr/>" ;
}

?>

</div>

<?php include("template/footer.php") ; ?>
