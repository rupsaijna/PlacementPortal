<?php

class security{

	public $status ;
	public $remote_ip ;
	public $fwding_ip ;
	public $cookie_value ;
	public $regno ;
	
	
	function __construct( $cookie_value , $remote_ip , $fwd_ip ) {
		$this->remote_ip = $remote_ip ;
		$this->fwding_ip = $fwd_ip ;
		$this->cookie_value = $cookie_value ;
		
		if( $cookie_value == "") { $this->status = 2 ; }
		else { 
			if( $this->check() == True ){
				$row = query_database( "SELECT * FROM `session` WHERE `cookie_value` = '".$cookie_value."'" ) ;
				if( $this->remote_ip != $row["remote_addr"] || $this->fwding_ip != $row["forwarded_for"] ){
					mysql_query("DELETE FROM `session` WHERE `cookie_value` = ".$cookie_value ) ;
					$this->status = 0 ;
				}
				else { 
					$this->status = 1 ; 
					$this->regno = $row["regno"] ;		
				}				
			} else {
				$this->status = 0 ;
			}
		}
	}

	private function check(){
//		echo $this->cookie_value ;
		$result = mysql_query("SELECT * FROM `session` WHERE `cookie_value` = '".$this->cookie_value."'" ) ;
		$no_rows = mysql_num_rows( $result );
		if( $no_rows != 0 ){			
			return True ; 
		}
		return False ;
	}


	function create($reg_no){
		$token_len = 12 ;
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
		$cookie_val = $token;
		
		mysql_query("INSERT INTO `session` (`regno`, `remote_addr`, `forwarded_for`, `timestamp`, `cookie_value`) VALUES ('".$reg_no."', '". $this->remote_ip ."', '". $this->fwding_ip ."', CURRENT_TIMESTAMP, '".$cookie_val."');");
		$this->status = 1 ;
		return $cookie_val ;
	}

	function delete(){
		mysql_query("DELETE FROM `session` WHERE `cookie_value` = '".$this->cookie_value."'" ) ;
	}

}


?>

<?php

	/*
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
		echo $secure->status."<br/>" ;

		if( $secure->status == 0 ){
			setcookie("student", "", time()-3600);
			$secure->delete();
			echo "go log in!" ;
		}

		if( $secure->status == 1 ){
			echo "u r on!" ;
		}


		if( $secure->status == 2 ){
			$val = $secure->create();
			//echo "started!";
			setcookie("student", $val , time()+3600) ;
			header("location:".$location."/student_companies.php") ;
		}
*/
?>


