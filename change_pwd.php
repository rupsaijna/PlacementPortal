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

if( isset( $_POST['pwrd'] )){
	$query = "UPDATE `pass_details` SET `password` = '".$_POST['pwrd']."' WHERE `RegNo` =".$studentid ;

	mysql_query( $query );
	include("template/header.php") ;
	include("template/nav_stu.php") ;
?>
<div class="dp100" style="padding-top:125px;padding-bottom:125px;">
<div class="dp25">&nbsp;</div>

<div class="dp50 message" >
Password Changed. Please <a href="student_companies.php">click here</a> to go back to <a href="student_companies.php">list of companies</a>.
</div>

<div class="dp25">&nbsp;</div>

</div>

<?php include("template/footer.php") ; ?>


<?php
}
else {
?>

<?php include("template/header.php") ; ?>

<?php include("template/nav_stu.php") ; ?>


<div class="dp100" style="padding-top:125px;padding-bottom:125px;">
<div class="dp20">&nbsp;</div>
<div class="dp20">&nbsp;</div>
<div class="dp25" >

<form action="change_pwd.php" method="POST">
<input type="password" name="pwrd" id="" value=""/><br/>
<input type="submit" value="Change Password" />
</form>


</div>
<div class="dp25">&nbsp;</div>
</div>

<?php include("template/footer.php") ; ?>


<?php
}
?>
