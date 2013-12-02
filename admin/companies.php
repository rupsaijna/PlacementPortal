<?PHP
include "../sql.php";
if (!isset($_COOKIE["admin"])){ header("location:".$location."/admin/index.php"); }
?>

<?php include("template/header.php") ; ?>

<?php include("template/nav.php") ; ?>


<div class="dp100" style="">
<table class="company_listing">
<?PHP
//echo "SELECT * FROM `recruitments` order by `Status`" ; 
$result = mysql_query("SELECT * FROM `recruitments` order by `Status`");
while($row = mysql_fetch_array($result))
  {
	switch ( $row['Status']  ){
		case 0 :
			echo '<tr bgcolor="#BEE554">';
			echo '<td><a href="students.php?r='.$row['RecId'].'">' . $row['CompanyName'] . '</a></td>' ;
                        echo '<td><b>Open</b> / <a class="s" href="changestatus.php?s=1&r='.$row['RecId'].'">Stop</a> / <a class="c" href="changestatus.php?s=2&r='.$row['RecId'].'">Close</a></td>';
			//echo '<td><a href="register.php?r='.$row['RecId'].'" target="_blank"> Register </a></td>' ;			
			echo '</tr>' ;
			break;

		case 1 :
			echo '<tr bgcolor="#FFC469">';
			echo '<td><a href="students.php?r='.$row['RecId'].'">' . $row['CompanyName'] . '</a></td>' ;
                        echo '<td><a class="o" href="changestatus.php?s=0&r='.$row['RecId'].'">Open</a> / <b>Stop</b> / <a class="c" href="changestatus.php?s=2&r='.$row['RecId'].'">Close</a></td>';
			//echo '<td><a href="register.php?r='.$row['RecId'].'" target="_blank"> Register </a></td>' ;			
			echo '</tr>' ;
			break;

		case 2 :
			echo '<tr bgcolor="#FF6666">';
			echo '<td><a href="students.php?r='.$row['RecId'].'">' . $row['CompanyName'] . '</a></td>' ;
                        echo '<td><a class="o" href="#">Open</a> / <a class="s" href="#">Stop</a> / <b>Close</b></td>';
			//echo '<td><a href="register.php?r='.$row['RecId'].'" target="_blank"> Register </a></td>' ;			
			echo '</tr>' ;
 			break;
	}
 }
?>
</table>

</div>

<?php include("template/footer.php") ; ?>

