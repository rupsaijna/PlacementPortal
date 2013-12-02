<?PHP
include "../sql.php";
if (!isset($_COOKIE["admin"])){ header("location:".$location."/admin/index.php"); }

$r = $_GET['r'];

mysql_query(" UPDATE `pass_details` SET `password` =  `dob` WHERE `RegNo` ='". $r ."'  ; ");

header("location:".$location."/admin/search.php");
