
<?php include("template/header.php") ; ?>

<?php include("template/nav.php") ; ?>


<div class="dp100" style="">
<form action="search.php" method="POST">
<table>
	<tr>
		<td><table>
			<tr><td>Reg No : <input type="text" name="rno" id="" /></td></tr>
			<tr><td>Branch : <select name="bno">
								<option value="--">--------</option>
								<option value="34"> B.E. Automobile</option>
								<option value="33"> B.E. Aeronautical</option>
								<option value="02"> B.E. Biomed.</option>
								<option value="24"> B.E. Biotech.</option>
								<option value="04"> B.E. Civil</option>
								<option value="03"> B.E. Chemical</option>
								<option value="05"> B.E. Computer Sc.</option>
								<option value="07"> B.E. ECE</option>
								<option value="06"> B.E. EEE</option>
								<option value="21"> B.E. ICE</option>
								<option value="08"> B.E. Ind. Prod.</option>
								<option value="11"> B.E. IT</option>
								<option value="09"> B.E. Mechanical</option>
								<option value="29"> B.E. Mechatronics</option>
								<option value="10"> B.E. Printing</option>
								<option  value="12"> M. Tech. Biomed</option>
								<option  value="46"> M. Tech. Biotech.</option>
								<option  value="49"> M. Tech. Chem.&nbsp;&nbsp;</option>
								<option  value="50"> M. Tech. Environ.</option>
								<option  value="18"> M. Tech. Struct</option>
								<option  value="14"> M. Tech. Construction</option>
								<option  value="13"> M. Tech. CSE</option>
								<option  value="48"> M. Tech. Comp.Sc & Info.Sec.</option>
								<option  value="15"> M. Tech. DEAC</option>
								<option  value="42"> M. Tech. Micrroele.</option>
								<option  value="43"> M. Tech. PESC&nbsp;</option>
								<option  value="16"> M. Tech. EMAL</option>
								<option  value="44"> M. Tech. Space</option>
								<option  value="25"> M. Tech. Control Sys.</option>
								<option  value="27"> M. Tech. Network</option>
								<option  value="28"> M. Tech. SE</option>
								<option  value="22"> M. Tech. CAMDA</option>
								<option  value="17"> M. Tech. Eng. Mangmnt</option>
								<option  value="26"> M. Tech. Manufc.</option>
								<option  value="30"> M. Tech. Nuclear</option>
								<option  value="45"> M. Tech. Printing</option>
							 </select>
			
			</td></tr>
		</table></td>
		<td><table>
			<tr>
				<td><input type="checkbox" name="all" id="" value="all" />Blocked</td>
			</tr>
			<tr>
				<td><input type="checkbox" name="int" id="" value="int"  />Internship</td>
			</tr>
			<tr>
				<td><input type="checkbox" name="cor" id="" value="cor"  />Core</td>
			</tr>
		</table></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" name="submit" value="Search" /></td>
	</tr>
</table>
</form>
<?php

if( !isset( $_POST["submit"] ) ){ 
?>

</div>

<?php include("template/footer.php") ; ?>

<?php
exit ; }

include "../sql.php";

function student_list( $sqll , $con ){
	
	//echo $sqll ;

	if( !mysql_query($sqll,$con)){
			die('Error: '. mysql_error());
	} else {
		$result = mysql_query($sqll,$con);
		echo "Number of students found : ".mysql_num_rows($result) ;
		echo "<br/>List Of Found Students:<br/> ";
		echo '<table>';
		echo '<th><tr><td>Reg No</td><td>Name</td><td>Email</td><td>Ph No</td><td>CGPA</td><td>Blocked</td><td>Core</td><td>Internship</td><td>Reset Pwd</td></th></tr>';
		while($row = mysql_fetch_array($result)) {
			echo "<tr><td><a href=\"student.php?r=".$row['RegNo']."\">".$row['RegNo']."</a></td>" ; 
			echo '<td>'. $row['Name'] .'</td>' ;
			echo '<td>'. $row['Email'] .'</td>' ;
			echo '<td>'. $row['Phno'] .'</td>' ;
			echo '<td>'. $row['CGPA'] .'</td>' ;
			
			if ( $row['allowed_all'] == 1  ) { $overall_string = '<b>locked</b>/<a href="unlock.php?r='.$row['RegNo'].'&s=a">unlock</a>' ; } 
			else { $overall_string = '<a href="lock.php?r='.$row['RegNo'].'&s=a">lock</a>/<b>unlocked</b>' ; } ;

			if ( $row['allowed_core'] == 1 ) { $core_string = '<b>locked</b>/<a href="unlock.php?r='.$row['RegNo'].'&s=c">unlock</a>' ; } 
			else { $core_string = '<a href="lock.php?r='.$row['RegNo'].'&s=c">lock</a>/<b>unlocked</b>'; } ;

			if ( $row['allowed_internship'] == 1 ) { $internship_string = '<b>locked</b>/<a href="unlock.php?r='.$row['RegNo'].'&s=i">unlock</a>' ; } 
			else { $internship_string = '<a href="lock.php?r='.$row['RegNo'].'&s=i">lock</a>/<b>unlocked</b>' ;} ;
			
			echo '<td>'. $overall_string .'</td>' ;
			echo '<td>'. $core_string .'</td>' ;
			echo '<td>'. $internship_string .'</td>' ;
			echo '<td><a href="reset.php?r='.$row['RegNo'].'">Reset Pwd</a></td></tr>' ;
			
		}
		echo '</table>';
	}

}

function return_tablename($id){ 
		
		//$stubranch = $id[4].$id[5] ;
		$stubranch = $id ;
		
		if ( in_array( $stubranch , array(34,33,02,04,24,03,05,06,07,21,08,11,09,29,10) ) ){ return "be"; }
		if ( in_array( $stubranch[1] , array(8,9) ) && $stubranch<10){ return "be"; }

		if ( in_array( $stubranch , array(12,46,49,50,18,14,13,48,15,42,43,16,44,25,27,28,22,17,26,30,45,19) ) ){return "mt" ;}
		
}


$rno = "" ;$all ="" ; $cor = ""; $int = "";
$rno = $_POST["rno"];
$bno = $_POST["bno"];
if( isset( $_POST["all"] ) ){$all = $_POST["all"];}
if( isset( $_POST["int"] ) ){$int = $_POST["int"];}
if( isset( $_POST["cor"] ) ){$cor = $_POST["cor"];}


if($rno != ""){ 
	$table = return_tablename( $rno[4].$rno[5] ) ;
	$SQLQuery = "SELECT  * from `".$table."_student_details` WHERE `RegNo` =". $rno ; 
	//echo $SQLQuery;
	student_list( $SQLQuery , $con ) ;
	exit ;
}


if($bno == "--"){
	$asql = "" ;
	$table = return_tablename( $bno );
	if( $all == "all" ){ $asql = " `allowed_all` = 1" ; }
	if( $cor == "cor" ){ $asql = " `allowed_core` = 1" ;}
	if( $int == "int" ){ $asql = " `allowed_internship` = 1" ; }
	$SQLQuery = "SELECT  * from `".$table."_student_details` WHERE ".$asql ; 
	student_list( $SQLQuery , $con ) ;
	exit;
}


if($bno != "--"){ 
	$asql = "" ;
	$table = return_tablename( $bno );
	if( $all == "all" ){ $asql = "AND `allowed_all` = 1" ; }
	if( $cor == "cor" ){ $asql = "AND `allowed_core` = 1" ; }
	if( $int == "int" ){ $asql = "AND `allowed_internship` = 1" ; }


	$SQLQuery = "SELECT * from `".$table."_student_details` WHERE `RegNo` LIKE '____". $bno . "___'".$asql ; 
	student_list( $SQLQuery , $con ) ;
	exit;
}


?>

</div>

<?php include("template/footer.php") ; ?>
