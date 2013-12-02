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

} else {
	header("location:".$location."/index.php") ;
}

function tenner( $tt ) {
	if ( $tt == '10' ){
		return 'NA' ;
	}
	return $tt;
}


function zeroer( $tt ) {
	if ( $tt == '0' ){
		return 'NA' ;
	}
	return $tt;
}


function centur( $tt ) {
	if ( $tt == '100' ){
		return 'NA' ;
	}
	return $tt;
}

?>

<?php include("template/header.php") ; ?>

<?php include("template/nav_stu.php") ; ?>


<div class="dp100" style=""><h3><font color="red">If you are seeing someone else's details, press f5</font></h3>
<?php
//header("location:".$location."/student.php") ;
function return_tablename($id){
		
		$stubranch = $id[4].$id[5] ;
		//$stubranch = $id ;
		
		if ( in_array( $stubranch , array(34,33,02,04,24,03,05,06,07,21,08,11,09,29,10) ) ){ return "be"; }
		//if ( in_array( $stubranch[1] , array(8,9) ) && $stubranch<10){ return "be"; }

		if ( in_array( $stubranch , array(12,46,49,50,18,14,13,48,15,42,43,16,44,25,27,28,22,17,26,30,45,19) ) ){return "mt" ;}
		
}

$studentid = (string) $studentid ;
if( strlen( $studentid ) == 8 ){ $studentid = "0".$studentid ; }
//echo $studentid ;
$table = return_tablename( (int) $studentid ); //echo $table ;

$result = mysql_query("SELECT * FROM `". $table ."_student_details` WHERE `RegNo` = ". $studentid );


if ( $table == "be" ) {

while($row = mysql_fetch_array($result)){
	echo "<fieldset><legend><h4>Personal Details:</h4></legend>";
	echo "<table>" ;
	echo "<tr><td><b>Name</b></td><td>".$row['Name']."</td><tr>";// <td></td>   <td><b></b></td><td></td>
	if ($row['Gender'] == "0") { $gender = "Female";} else { $gender = "Male" ;}
	echo "<tr><td><b>Gender</b></td><td>".$gender."</td><tr>";// <td></td>
	echo "<tr><td><b>Reg No</b></td><td>".$row['RegNo']."</td><tr>";// <td></td>
	echo "<tr><td><b>E-mail</b></td><td><a href=\"mailto:".$row['Email']."\">".$row['Email']."</a></td><tr>";// <td></td> 
	echo "<tr><td><b>Ph.No</b></td><td>".$row['Phno']."</td><tr>";// <td></td>
	//echo "<tr><td><b>E-mail</b></td><td>".$row['']."</td><tr>";// <td></td>
	echo "</table>" ;
	echo "</fieldset><br/>";
	
	echo "<fieldset><legend><h4>Pre BE:</h4></legend>";
	echo "<table>" ;
	echo "<tr><td><b>10</b></td><td>".$row['M10']."</td><tr>";// <td></td>   <td><b></b></td><td></td>
	echo "<tr><td><b>12</b></td><td>".$row['M12']."</td><tr>";// <td></td>
	echo "<tr><td><b>Diploma</b></td><td>".centur($row['MD'])."</td><tr>";// <td></td>
	echo "</table>" ;
	echo "</fieldset><br/>";
	
	echo "<fieldset><legend><h4>BE Details:</h4></legend>";
	echo "<table>" ;
	echo "<tr><td><b></b></td><td><b>GPA</b></td></tr>";
	echo "<tr><td><b>1</b></td><td>".tenner($row['GPA1'])."</td></tr>";
	echo "<tr><td><b>2</b></td><td>".tenner($row['GPA2'])."</td></tr>";
	echo "<tr><td><b>3</b></td><td>".$row['GPA3']."</td></tr>";
	echo "<tr><td><b>4</b></td><td>".$row['GPA4']."</td></tr>";
	echo "<tr><td><b>5</b></td><td>".$row['GPA5']."</td></tr>";
	echo "<tr><td><b>6</b></td><td>".$row['GPA6']."</td></tr>";
	echo "<tr><td><b>7</b></td><td>".tenner($row['GPA7'])."</td></tr>";
	echo "<tr><td><b>8</b></td><td>".tenner($row['GPA8'])."</td></tr>";
	echo "</table>" ;
	echo "<table>" ;
	echo "<tr><td><b></b></td><td><b>CGPA</b></td><td><b>Total<br/>Backlog</b></td><td><b>Total<br/>Date Change</b></td><tr>";
	echo "<tr><td><b></b></td><td>".$row['CGPA']."</td><td>".$row['TBL']."</td><td>".$row['TSP']."</td><tr>";
	echo "</table>" ;
	echo "</fieldset><br/>";

//	var_dump( $row ) ;
} } 


if ( $table == "mt" ) {

while($row = mysql_fetch_array($result)){
	echo "<fieldset><legend><h4>Personal Details:</h4></legend>";
	echo "<table>" ;
	echo "<tr><td><b>Name</b></td><td>".$row['Name']."</td><tr>";// <td></td>   <td><b></b></td><td></td>
	if ($row['Gender'] == "0") { $gender = "Female";} else { $gender = "Male" ;}
	echo "<tr><td><b>Gender</b></td><td>".$gender."</td><tr>";// <td></td>
	echo "<tr><td><b>Reg No</b></td><td>".$row['RegNo']."</td><tr>";// <td></td>
	echo "<tr><td><b>E-mail</b></td><td><a href=\"mailto:".$row['Email']."\">".$row['Email']."</a></td><tr>";// <td></td> 
	echo "<tr><td><b>Ph.No</b></td><td>".$row['Phno']."</td><tr>";// <td></td>
	//echo "<tr><td><b>E-mail</b></td><td>".$row['']."</td><tr>";// <td></td>
	echo "</table>" ;
	echo "</fieldset><br/>";
	
	echo "<fieldset><legend><h4>Pre MTech:</h4></legend>";
	echo "<table>" ;
	echo "<tr><td><b>10</b></td><td>".$row['M10']."</td><tr>";// <td></td>   <td><b></b></td><td></td>
	echo "<tr><td><b>12</b></td><td>".$row['M12']."</td><tr>";// <td></td>
	echo "<tr><td><b>Diploma</b></td><td>".$row['MD']."</td><tr>";// <td></td>
	echo "<tr><td><b>BE Marks</b></td><td>".$row['MB']."</td><tr>";// <td></td>
	echo "</table>" ;
	echo "</fieldset><br/>";
	
	echo "<fieldset><legend><h4>MTech Details:</h4></legend>";
	echo "<table>" ;
	echo "<tr><td><b></b></td><td><b>CGPA</b></td><td><b>Total<br/>Backlog</b></td><td><b>Total<br/>Date Change</b></td><tr>";
	echo "<tr><td><b></b></td><td>".$row['CGPA']."</td><td>".$row['TBL']."</td><td>".$row['TSP']."</td><tr>";
	echo "</table>" ;
	echo "</fieldset><br/>";

//	var_dump( $row ) ;
} } 

?>

</div>

<?php include("template/footer.php") ; ?>
