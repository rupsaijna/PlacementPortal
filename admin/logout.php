<?PHP
include '../sql.php';
setcookie("admin", "", time()-3600);
header("location:".$location."/admin/companies.php");
?>
