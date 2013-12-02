<?php
include "../sql.php";
if (!isset($_COOKIE["admin"])){ header("location:".$location."/admin/index.php"); }
?>
<?php include("template/header.php") ; ?>

<?php include("template/nav.php") ; ?>


<div class="dp100" style="">
<?php
$q = "UPDATE `be_student_details` SET `Email`=\"".$_POST["email"]."\" , `Phno`=\"".$_POST["phno"]."\" , `M10`=\"".$_POST["ten"]."\" , `M12`=\"".$_POST["twelv"]."\" , `MD`=\"".$_POST["dip"]."\" , `GPA1`=\"".$_POST["g1"]."\" , `GPA2`=\"".$_POST["g2"]."\" , `GPA3`=\"".$_POST["g3"]."\" , `GPA4`=\"".$_POST["g4"]."\" , `GPA5`=\"".$_POST["g5"]."\" , `GPA6`=\"".$_POST["g6"]."\" , `GPA7`=\"".$_POST["g7"]."\" , `GPA8`=\"".$_POST["g8"]."\" , `CGPA`=\"".$_POST["cgpa"]."\" , `TBL`=\"".$_POST["tbl"]."\" , `TSP`=\"".$_POST["tsp"]."\" WHERE `RegNo` = \"". $_POST["regno"]."\"" ;
//echo $q ;
mysql_query( $q );

echo "The student details have been updated. Click <a href=\"student.php?r=". $_POST['regno'] ."\">here</a> to go back to view details. ";
?>

</div>
<?php include("template/footer.php") ; ?>
