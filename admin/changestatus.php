<?PHP
include "../sql.php";
if (!isset($_COOKIE["admin"])){ header("location:".$location."/admin/index.php"); }
?>

<?PHP
//cookie check
if(  isset($_GET["r"]) &&  isset($_GET["s"])  ){
	$sqll = "UPDATE `recruitments` SET `Status` = '". $_GET["s"] ."' WHERE `recruitments`.`RecId` =".$_GET["r"] ;
//echo $sqll ;
	mysql_query( $sqll , $con );
	header( 'Location: '.$location.'/admin/companies.php' ) ;
}

