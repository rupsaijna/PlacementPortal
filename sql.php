<?PHP
//$location = 'http://localhost/placements'; // localhost
$location = 'http://172.16.61.204';// MIT
//$con = mysql_connect("localhost","trshant","cybhat"); // localhost
$con = mysql_connect("localhost","root","muADMIN#123");// MIT
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("placement", $con); // localhost
//mysql_select_db("placements", $con); // MIT


$branch_name = array(
"34" => "AU",
"33" => "AE",
"02" => "BM",
"24" => "BT",
"04" => "CV",
"03" => "CH",
"05" => "CS",
"07" => "EC",
"06" => "EE",
"21" => "IC",
"08" => "IP.",
"11" => "IT",
"09" => "ME",
"29" => "MT",
"10" => "PMT",
"12" => "M. Tech. Biomed",
"46" => "M. Tech. Biotech.",
"49" => "M. Tech. Chem.&nbsp;&nbsp;",
"50" => "M. Tech. Environ.",
"18" => "M. Tech. Struct",
"14" => "M. Tech. Construction",
"13" => "M. Tech. CSE",
"48" => "M. Tech. Comp.Sc & Info.Sec.",
"15" => "M. Tech. DEAC",
"42" => "M. Tech. Micrroele.",
"43" => "M. Tech. PESC&nbsp;",
"16" => "M. Tech. EMAL",
"44" => "M. Tech. Space",
"25" => "M. Tech. Control Sys.",
"27" => "M. Tech. Network",
"28" => "M. Tech. SE",
"22" => "M. Tech. CAMDA",
"17" => "M. Tech. Eng. Mangmnt",
"26" => "M. Tech. Manufc.",
"30" => "M. Tech. Nuclear",
"45" => "M. Tech. Printing" ) ;


function query_database($query){
 		//echo $query ;
		$result = mysql_query($query);
		$row = mysql_fetch_assoc($result);
		//var_dump($row);
		return($row);
	}
        

?>
