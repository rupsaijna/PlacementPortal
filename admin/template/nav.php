<div class="dp100" style="border-bottom:1px solid #000;">
<ul class="navl">
<li><a href="companies.php">Home</a></li>
<li><a href="add_company_form.html">Add Company</a></li>
<li><a href="search.php">Search</a></li>
<li>

<select class="comp_drop" onchange="window.open(this.options[this.selectedIndex].value,'_top')">
    <option value="">Choose a Company</option>
	<option value="companies.php"><b>All Companies</b></option>
<?PHP
$result = mysql_query("SELECT * FROM recruitments order by `Status`");
while($row = mysql_fetch_array($result)){
	echo '<option class="';
	switch ( $row['Status']  ){
		case 0 :
			echo 'o';
			break;
		case 1 :
			echo 's';
			break;
		case 2 :
			echo 'c';
			break;
	}
	echo '" value="students.php?r='.$row['RecId'].'">'.$row['CompanyName'].'</option>';
}
?>
</select>

</li>
</ul>

<ul class="navr">
<!--li><a href="change_pwd.php">Change Pwd</a></li-->
<li><a href="logout.php">Logout</a></li>
</ul>

</div>
