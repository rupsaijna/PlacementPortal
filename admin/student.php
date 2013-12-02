<?php
include "../sql.php";
if (!isset($_COOKIE["admin"])){ header("location:".$location."/admin/index.php"); }
?>
<?php include("template/header.php") ; ?>

<?php include("template/nav.php") ; ?>


<div class="dp100" style="">
<?php

function return_tablename($id){
		
		$stubranch = $id[4].$id[5] ;
		//$stubranch = $id ;
		
		if ( in_array( $stubranch , array(34,33,02,04,24,03,05,06,07,21,08,11,09,29,10) ) ){ return "be"; }
		if ( in_array( $stubranch[1] , array(8,9) ) && $stubranch<10){ return "be"; }
		if ( in_array( $stubranch , array(12,46,49,50,18,14,13,48,15,42,43,16,44,25,27,28,22,17,26,30,45,19) ) ){return "mt" ;}
		
}
$id=$_GET['r'];
$id = (string) $id ;
if( strlen( $id ) == 8 ){ $id = "0".$id ; }

$table = return_tablename( $id ); //echo $table ;

$result = mysql_query("SELECT * FROM `". $table ."_student_details` WHERE `RegNo` = ". $id);

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
	echo "<tr><td><b>Diploma</b></td><td>".$row['MD']."</td><tr>";// <td></td>
	echo "</table>" ;
	echo "</fieldset><br/>";
	
	echo "<fieldset><legend><h4>BE Details:</h4></legend>";
	echo "<table>" ;
	echo "<tr><td><b></b></td><td><b>GPA</b></td><td><b>Backlog</b></td><td><b>Date Change</b></td><tr>";
	echo "<tr><td><b>1</b></td><td>".$row['GPA1']."</td></tr>";
	echo "<tr><td><b>2</b></td><td>".$row['GPA2']."</td></tr>";
	echo "<tr><td><b>3</b></td><td>".$row['GPA3']."</td></tr>";
	echo "<tr><td><b>4</b></td><td>".$row['GPA4']."</td></tr>";
	echo "<tr><td><b>5</b></td><td>".$row['GPA5']."</td></tr>";
	echo "<tr><td><b>6</b></td><td>".$row['GPA6']."</td></tr>";
	echo "<tr><td><b>7</b></td><td>".$row['GPA7']."</td></tr>";
	echo "<tr><td><b>8</b></td><td>".$row['GPA8']."</td></tr>";
	echo "</table>" ;
	echo "<table>" ;
	echo "<tr><td><b></b></td><td><b>CGPA</b></td><td><b>Total<br/>Backlog</b></td><td><b>Total<br/>Date Change</b></td><tr>";
	echo "<tr><td><b></b></td><td>".$row['CGPA']."</td><td>".$row['TBL']."</td><td>".$row['TSP']."</td><tr>";
	echo "</table>" ;
	echo "</fieldset><br/>";
	echo "<a href=\"editstudent.php?r=".$row['RegNo']."\">Edit Student</a>";


	if ( $row['allowed_all'] == 1  ) { $overall_string = '<b>locked</b>/<a href="unlock.php?r='.$id.'&s=a">unlock</a>' ; } 
	else { $overall_string = '<a href="lock.php?r='.$id.'&s=a">lock</a>/<b>unlocked</b>' ;} ;

	if ( $row['allowed_core'] == 1 ) { $core_string = '<b>locked</b>/<a href="unlock.php?r='.$id.'&s=c">unlock</a>' ; } 
	else { $core_string = '<a href="lock.php?r='.$id.'&s=c">lock</a>/<b>unlocked</b>'; } ;

	if ( $row['allowed_internship'] == 1 ) { $internship_string = '<b>locked</b>/<a href="unlock.php?r='.$id.'&s=i">unlock</a>'; } 
	else { $internship_string = '<a href="lock.php?r='.$id.'&s=i">lock</a>/<b>unlocked</b>'; } ;

	if ( $row['allowed_pc'] == 1 ) { $pc_string = '<b>locked</b>/<a href="unlock.php?r='.$id.'&s=p">unlock</a>'; } 
	else { $pc_string = '<a href="lock.php?r='.$id.'&s=p">lock</a>/<b>unlocked</b>'; } ;
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

	if ( $row['allowed_all'] == 1  ) { $overall_string = '<b>locked</b>/<a href="unlock.php?r='.$id.'&s=a">unlock</a>' ; } 
	else { $overall_string = '<a href="lock.php?r='.$id.'&s=a">lock</a>/<b>unlocked</b>' ;} ;

	if ( $row['allowed_core'] == 1 ) { $core_string = '<b>locked</b>/<a href="unlock.php?r='.$id.'&s=c">unlock</a>' ; } 
	else { $core_string = '<a href="lock.php?r='.$id.'&s=c">lock</a>/<b>unlocked</b>'; } ;

	if ( $row['allowed_internship'] == 1 ) { $internship_string = '<b>locked</b>/<a href="unlock.php?r='.$id.'&s=i">unlock</a>'; } 
	else { $internship_string = '<a href="lock.php?r='.$id.'&s=i">lock</a>/<b>unlocked</b>'; } ;
		
	if ( $row['allowed_pc'] == 1 ) { $pc_string = '<b>locked</b>/<a href="unlock.php?r='.$id.'&s=p">unlock</a>'; } 
	else { $pc_string = '<a href="lock.php?r='.$id.'&s=p">lock</a>/<b>unlocked</b>'; } ;
} } 

echo "<fieldset><legend><h4>Registered For:</h4></legend>";
echo "<table>" ;
$result = mysql_query("SELECT `recruitments`.`CompanyName`, `recruitments`.`RecId`, `recruitments`.`Status` , `students`.`RegNo` , `students`.`rstuid` from `recruitments`, `students` where `recruitments`.`RecId` = `students`.`RecId` and `students`.`RegNo` = ". $_GET['r'] );
while($row = mysql_fetch_array($result)){
	echo "<tr><td>". $row['CompanyName'] ."</td></tr>";
}
echo "</table>" ;
echo "</fieldset>";


?>
<fieldset><legend><h4>Lock Status</h4></legend>
<table>
	<tr>
		<td>Blacklisted</td>
		<td><?php echo $overall_string; ?></td>
	</tr>
	<tr>
		<td>Core</td>
		<td><?php echo $core_string ; ?></td>
	</tr>
	<tr>
		<td>Internship</td>
		<td><?php echo $internship_string ; ?></td>
	</tr>

	<tr>
		<td>PC</td>
		<td><?php echo $pc_string ; ?></td>
	</tr>
</table>
<fieldset>

</div>

<?php include("template/footer.php") ; ?>
