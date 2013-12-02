<?PHP
include "../sql.php";
if (!isset($_COOKIE["admin"])){ header("location:".$location."/admin/index.php"); }
?>

<?php include("template/header.php") ; ?>

<?php include("template/nav.php") ; ?>


<div class="dp100" style="">

<?PHP
$result2 = mysql_query('SELECT * FROM recruitments where `RecId`='.$_GET["r"]);
while($row2 = mysql_fetch_array($result2)){
	echo $row2['HTML'];
	$form_status = $row2['form'];
}
?>
<a href="edit_company_form.php?r=<?php echo $_GET["r"] ; ?>">Edit Criteria</a>
<hr/>
<?PHP
include "../class_validate.php";
if( isset($_POST["regno"]) ){
	$student = new validation( $_POST["regno"] , $_POST["reqno"] );
	$student->validate_relax();
	echo $student->message ;
	echo "<br/><a href=\"student.php?r=".$_POST["regno"]."\">".$_POST["regno"]."</a><hr/>";
}
?>
<form action="students.php?r=<?PHP echo $_GET["r"] ?>" method="post">
<input type="hidden" name="reqno" value="<?PHP echo $_GET["r"]; ?>" >
Enter Registration Number:<input name="regno" type="text"/>
<input type="submit"/>
</form>
<br>
*Relaxed Validation. Checks 1) If already registered and 2) If branch is allowed.
<hr/>

<?PHP
//cookie check
if(  isset($_GET["r"]) ){

    // "SELECT `RegNo`,`Name`,`Email`,`Phno`,`CGPA` from `be_student_details` where `RegNo` in ( select `RegNo` from `students` where `RecId`= :. $_GET["r"] ." )"

	//$sqll = 'SELECT * FROM `students` WHERE `RecId`='.$_GET["r"];
	//$sqll = "SELECT `RegNo`,`Name`,`Email`,`Phno`,`CGPA` from `be_student_details` where `RegNo` in ( select `RegNo` from `students` where `RecId`= ". $_GET["r"] ." )" ;
	$sqll = "SELECT  `be_student_details`.`RegNo`,`be_student_details`.`Name`,`be_student_details`.`PC1`,`be_student_details`.`PC2`,`be_student_details`.`Email`,`be_student_details`.`Phno`,`be_student_details`.`CGPA` , `students`.`rstuid` , `students`.`RecId`,`students`.`form_value` from `be_student_details` LEFT JOIN `students` ON `students`.`RegNo` = `be_student_details`.`RegNo` where `students`.`RecId` =". $_GET["r"] ;
	$sqll .= " UNION ";
	$sqll .= "SELECT  `mt_student_details`.`RegNo`,`mt_student_details`.`Name`,`mt_student_details`.`PC1`,`mt_student_details`.`PC2`,`mt_student_details`.`Email`,`mt_student_details`.`Phno`,`mt_student_details`.`CGPA` , `students`.`rstuid` , `students`.`RecId`,`students`.`form_value` from `mt_student_details` LEFT JOIN `students` ON `students`.`RegNo` = `mt_student_details`.`RegNo` where `students`.`RecId` =". $_GET["r"] ;
	//echo $sqll,'<br/>' ;
	if( !mysql_query($sqll,$con)){
		die('Error: '. mysql_error());
	} else {
		$result = mysql_query($sqll,$con);
		echo "<br>Number of students registered : ".mysql_num_rows($result);
		if(mysql_num_rows($result)>0){
		echo "<br/>List Of Registered Students:<br/> ";
		echo '<form method="post" action="saveselected.php?r='.$_GET["r"].'" ><table class="student_list">';
		echo '<tr><th></th><th>Reg No</th><th>Name</th><th>Email</th><th>Ph No</th><th>CGPA</th><th>Actions</th>';
		echo '<th></th><th>PC1</th><th>PC2</th><th>Values</th></tr>';
		while($row = mysql_fetch_array($result)) {
			echo "<tr><td><input type=\"checkbox\" name=\"selected[]\" value=\"".$row['rstuid']."\" /></td><td><a href=\"student.php?r=".$row['RegNo']."\">".$row['RegNo']."</a></td>" ; 
			echo '<td>'. $row['Name'] .'</td>' ;
			echo '<td>'. $row['Email'] .'</td>' ;
			echo '<td>'. $row['Phno'] .'</td>' ;
			echo '<td>'. $row['CGPA'] .'</td>' ;
			echo '<td><a href="deregister.php?r='. $row['rstuid'] .'&s='.$_GET["r"].'">Deregister</a></td>' ;
			echo '<td><input type="checkbox" name="pc[]" value="'.$row['rstuid'].'" /></td>' ;
			echo '<td>'. $row['PC1'] .'</td>' ;
			echo '<td>'. $row['PC2'] .'</td>' ;
			$fv = array(json_decode($row['form_value'] , true ) );
			$json = array_values($fv);
			foreach ( $json as $value){
				echo '<td>'. $value .'</td>' ;
			}
			
			echo '</tr>' ;  // $row['rstuid']
		}}
		echo '</table>';
	}
}
if(mysql_num_rows($result)>0){
?>
<br/>

<input type="submit" value="Save selected" />

<?php 
}
?>
</form>
<hr/>
<em>Save Selected</em> before downloading Selected CSV.<br/> 
<a href="SaveCSV.php?r=<?php echo $_GET["r"]; ?>"><button>Download CSV</button></a><br/>
<a href="SaveSelCSV.php?r=<?php echo $_GET["r"]; ?>"><button>Download CSV (selected)</button></a><br/>
</div>

<?php include("template/footer.php") ; ?>
