<?PHP
include 'sql.php';
include 'class_security.php';

		$token_len = 6 ;
		$token = "";
		$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
		$codeAlphabet.= "0123456789";
		for($i=0;$i<$token_len;$i++){
			do {
				$rnd = hexdec(bin2hex(openssl_random_pseudo_bytes(1)));
				$rnd = $rnd & 63; // discard irrelevant bits
			} while ($rnd >= 62);

			$token .= $codeAlphabet[ $rnd ];
		}
		$q = $token;

if( isset($_POST["u"]) && isset($_POST["p"]) )
{
	$result = mysql_query("SELECT `password` FROM `pass_details` WHERE `RegNo`=".$_POST["u"] );

	while( $row = mysql_fetch_array($result) )
	{
		$rr = $row['password'] ;
	}
	
	if( strcmp( $_POST["p"] , $rr )==0 ) {
		$reg = $_POST["u"] ;
		
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
		//echo "cookie = ".$cookie."<br/>" ;


		$secure = new security( $cookie , $_SERVER['REMOTE_ADDR'] , $fwd );
		//echo $secure->status."<br/>" ;

		if( $secure->status == 0 ){
			setcookie("student", "", time()-3600);
			$secure->delete();
			header("location:".$location."/index.php") ;
		}

		if( $secure->status == 1 ){
			header("location:".$location."/student_companies.php"."?z=".$q ) ;
		}


		if( $secure->status == 2 ){
			$val = $secure->create( $reg );
			//echo "started!";
			setcookie("student", $val , time()+3600) ;
			header("location:".$location."/student_companies.php"."?z=".$q ) ;
		}

		//header("location:".$location."/index.php") ;
//setcookie("student", "", time()-3600);
			//$secure->delete();
			//header("location:".$location."/index.php") ;
		
	}
}
?>

<?php include("template/header.php") ; ?>

<?php //include("template/nav.php") ; ?>


<div class="dp100" style="padding-top:125px;padding-bottom:125px;">
<div class="dp20">&nbsp;</div>
<div class="dp20">&nbsp;</div>
<div class="dp25" >

<form action="index.php" method="POST">
<h3><u>Student Login</u></h3>
Registration Number&nbsp;:&nbsp;<input type="text" name="u"/><br/>
Password&nbsp;:&nbsp;<input type="password" name="p"/><br/>
<input type="submit" value="Login"/>
</form>


</div>
<div class="dp25">&nbsp;</div>
</div>

<?php include("template/footer.php") ; ?>
