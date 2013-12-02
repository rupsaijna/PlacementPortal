<?PHP
include '../sql.php';
if( isset($_POST["u"]) && isset($_POST["p"]) )
{
	if( $_POST["u"] == "Admin" && strcmp(md5($_POST["p"]),'66851a738dd5c26df1cc7b9abed55e51')==0 ) {
		setcookie("admin", "Nakul", time()+3600);
		header("location:".$location."/admin/companies.php");
	}
}
?>
<?php include("template/header.php") ; ?>

<?php //include("template/nav.php") ; ?>


<div class="dp100" style="padding-top:125px;padding-bottom:125px;">
<div class="dp20">&nbsp;</div>
<div class="dp20">&nbsp;</div>
<div class="dp25" >

<form action="index.php" method="POST">
<h3><u>Admin Login</u></h3>
Username&nbsp;:&nbsp;<input type="text" name="u"/><br/>
Password&nbsp;:&nbsp;<input type="password" name="p"/><br/>
<input type="submit" value="Login"/>
</form>


</div>
<div class="dp25">&nbsp;</div>
</div>

<?php include("template/footer.php") ; ?>
