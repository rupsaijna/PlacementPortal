<?PHP
include "../sql.php";
if (!isset($_COOKIE["admin"])){ header("location:".$location."/admin/index.php"); }
?>

<?php

include_once '../sql.php';



$html_string = '<table>' ;

$array = array(
    "cname" => $_POST['company_name'] ,
    "type" => $_POST['type'],
	"level" => $_POST['level'],
);

$html_string .= '<tr><td colspan="2"><b>Company Name : </b>'.$_POST['company_name'].'</td></tr>' ;

switch ( $_POST['type'] ){
case "c":
	$html_string .= '<tr><td colspan="2"><b>Type : </b>Core</td></tr>' ;
	break ;
case "m":
	$html_string .= '<tr><td colspan="2"><b>Type : </b>ITES</td></tr>' ;
	break ;
case "i":
	$html_string .= '<tr><td colspan="2"><b>Type : </b>Internship</td></tr>' ;
	break ;
}


$array["beb"] = array() ;



if (in_array("be", $_POST['level'] )) {
	
	$html_string .= '<tr><td>BTech Criteria :<table>' ;

    $array["beb"] = array_merge( $array['beb'] ,$_POST['beb'] ) ;
	
	$html_string .= '<tr><td><b>Branches : </b></td><td>';
	$branches =  $_POST['beb'] ;
	$branch_names = array();
	foreach ($branches as $i) {
		array_push($branch_names , $branch_name[$i] );
	}
	
	$html_string .= implode(", ", $branch_names ) ;
	$html_string .= '</td></tr>' ;
	
	$cgpa_choice = $_POST['begp'];
	$array["be_cgpa_choice"] = $cgpa_choice ;
	
	$html_string .= '<tr>' ;
	
	switch ($cgpa_choice) {
    case "cg":
		$html_string .= '<td><b>CGPA : </b></td>' ;
        $array["becgpa"] = $_POST['becgpa'] ;
		$html_string .= '<td>'.$_POST['becgpa'].'</td>' ;
        break;
    case 'cgps':
		$html_string .= '<td><b>GPA/Sem : </b></td>' ;
        $array["begpaps"] = $_POST['begpaps'] ;
		$html_string .= '<td>'.$_POST['begpaps'].'</td>' ;
        break;
    case 'cgbs':
		$html_string .= '<td><b>GPA by Sem : </b></td>' ;
		$array["begpa"] = $_POST['begpa'] ;
		$html_string .= '<td>'.implode(",", $_POST['begpa'] ).'</td>' ;
        break;
	}
	
	//$html_string .= '</tr>' ;
	
	//$html_string .= '<tr>' ;
	
	$bl_choice = $_POST['bebl'];
	$array["be_bl_choice"] = $bl_choice ;
	switch ($bl_choice) {
    case 'beblt':
		$html_string .= '<td><b>Total Backlogs : </b></td>' ;
        $array["beblt"] = $_POST['beblt'] ;
		$html_string .= '<td>'.$_POST['beblt'].'</td>' ;
        break;
    case 'beblbs':
		$html_string .= '<td><b>BLs by Sem : </b></td>' ;
		$array["beblbs"] = $_POST['bebls'] ;
		$html_string .= '<td>'.implode(",", $_POST['bebls'] ).'</td>' ;
        break;
	}
	
	//$html_string .= '</tr>' ;
	
	//$html_string .= '<tr>' ;
	
	$dc_choice = $_POST['bedc'];
	$array["be_dc_choice"] = $dc_choice ;
	switch ($dc_choice) {
    case 'bedct':
		$html_string .= '<td><b>Total Date Changes : </b></td>' ;
        $array["bedct"] = $_POST['bedct'] ;
		$html_string .= '<td>'.$_POST['bedct'].'</td>' ;
        break;
    case 'bedcbs':
		$html_string .= '<td><b> DCs by Sem: </b></td>' ;
		$array["bedcbs"] = $_POST['besdc'] ;
		$html_string .= '<td>'.implode(",", $_POST['besdc']).'</td>' ;
        break;
	}

	$html_string .= '</tr></table></td></tr>' ;
}



if (in_array("me", $_POST['level'] )) {

	$html_string .= '<tr><td>MTech Criteria :<br/><table>' ;

    $array["beb"] = array_merge( $array['beb'] , $_POST['meb'] );
	
	$html_string .= '<tr><td><b>Branches : </b></td><td>';
	$branches =  $_POST['meb'] ;
	$branch_names = array();
	foreach ($branches as $i) {
		array_push($branch_names , $branch_name[$i] );
	}
	
	$html_string .= implode(", ", $branch_names ) ;
	$html_string .= '</td></tr>' ;
	
	$cgpa_choice = $_POST['megp'];
	$array["me_cgpa_choice"] = $cgpa_choice ;
	
	$html_string .= '<tr>' ;
	
	switch ($cgpa_choice) {
    case "cg":
		$html_string .= '<td><b>CGPA Cutoff: </b></td>' ;
        $array["mecgpa"] = $_POST['mecgpa'] ;
		$html_string .= '<td>'.$_POST['mecgpa'].'</td>' ;
        break;
    case 'cgps':
		$html_string .= '<td><b>GPA/Sem : </b></td>' ;
        $array["megpaps"] = $_POST['megpaps'] ;
		$html_string .= '<td>'.$_POST['megpaps'].'</td>' ;
        break;
    case 'cgbs':
		$html_string .= '<td><b>GPA by Sem : </b></td>' ;
		$array["megpa"] = $_POST['megpa'] ;
		$html_string .= '<td>'.implode(",", $_POST['megpa'] ).'</td>' ;
        break;
	}
	
	$html_string .= '</tr>' ;
	
	$html_string .= '<tr>' ;
	
	$bl_choice = $_POST['mebl'];
	$array["me_bl_choice"] = $bl_choice ;
	switch ($bl_choice) {
    case 'meblt':
		$html_string .= '<td><b>Total BLs : </b></td>' ;
        $array["meblt"] = $_POST['meblt'] ;
		$html_string .= '<td>'.$_POST['meblt'].'</td>' ;
        break;
    case 'mebls':
		$html_string .= '<td><b>BLs by Sem : </b></td>' ;
		$array["meblbs"] = $_POST['mebls'] ;
		$html_string .= '<td>'.implode(",", $_POST['mebls'] ).'</td>' ;
        break;
	}
	
	$html_string .= '</tr>' ;
	
	$html_string .= '<tr>' ;
	
	$dc_choice = $_POST['medc'];
	$array["me_dc_choice"] = $dc_choice ;
	switch ($dc_choice) {
    case 'medct':
		$html_string .= '<td><b>Total DCs : </b></td>' ;
        $array["medct"] = $_POST['medct'] ;
		$html_string .= '<td>'.$_POST['medct'].'</td>' ;
        break;
    case 'medcs':
		$html_string .= '<td><b> DCs by Sem : </b></td>' ;
		$array["medcbs"] = $_POST['medcs'] ;
		$html_string .= '<td>'.implode(",", $_POST['medcs']).'</td>' ;
        break;
	}

	$array["be_gpa"] = $_POST["b_cgp"] ;
	$html_string .= '</tr><tr><td><b> CGPA in BE : </b></td><td>'.$_POST["b_cgp"].'</td>';
	$html_string .= '</tr></table></td></tr>' ;
	
	
}



if (in_array("mc", $_POST['level'] )) {

	$html_string .= '<tr><td>MCA Criteria :<br/><table>' ;

    //$array["beb"] = array_merge( $array['beb'] , $_POST['meb'] );
	//$html_string .= '<tr><td colspan="2"><b>Branches : </b>'. implode(",", $_POST['meb'] ).'</td></tr>' ;
	
	$cgpa_choice = $_POST['mcgp'];
	$array["mc_cgpa_choice"] = $cgpa_choice ;
	
	$html_string .= '<tr>' ;
	
	switch ($cgpa_choice) {
    case "cg":
		$html_string .= '<td><b>CGPA : </b></td>' ;
        $array["mccgpa"] = $_POST['mccgpa'] ;
		$html_string .= '<td>'.$_POST['mccgpa'].'</td>' ;
        break;
    case 'cgps':
		$html_string .= '<td><b>GPA/Sem : </b></td>' ;
        $array["mcgpaps"] = $_POST['mcgpaps'] ;
		$html_string .= '<td>'.$_POST['mcgpaps'].'</td>' ;
        break;
    case 'cgbs':
		$html_string .= '<td><b>GPA by Sem : </b></td>' ;
		$array["mcgpa"] = $_POST['mcgpa'] ;
		$html_string .= '<td>'.implode(",", $_POST['mcgpa'] ).'</td>' ;
        break;
	}
	
	$html_string .= '</tr>' ;
	
	$html_string .= '<tr>' ;
	
	$bl_choice = $_POST['mcbl'];
	$array["mc_bl_choice"] = $bl_choice ;
	switch ($bl_choice) {
    case 'mcblt':
		$html_string .= '<td><b>Total BLs : </b></td>' ;
        $array["meblt"] = $_POST['mcblt'] ;
		$html_string .= '<td>'.$_POST['mcblt'].'</td>' ;
        break;
    case 'mcbls':
		$html_string .= '<td><b>BLs by Sem : </b></td>' ;
		$array["mcblbs"] = $_POST['mcbls'] ;
		$html_string .= '<td>'.implode(",", $_POST['mcbls'] ).'</td>' ;
        break;
	}
	
	$html_string .= '</tr>' ;
	
	$html_string .= '<tr>' ;
	
	$dc_choice = $_POST['mcdc'];
	$array["mc_dc_choice"] = $dc_choice ;
	switch ($dc_choice) {
    case 'mcdct':
		$html_string .= '<td><b>Total DCs : </b></td>' ;
        $array["mcdct"] = $_POST['mcdct'] ;
		$html_string .= '<td>'.$_POST['mcdct'].'</td>' ;
        break;
    case 'mcdcs':
		$html_string .= '<td><b> DCs by Sem: </b></td>' ;
		$array["mcdcbs"] = $_POST['mcdcs'] ;
		$html_string .= '<td>'.implode(",", $_POST['mcdcs']).'</td>' ;
        break;
	}

	$html_string .= '</tr></table></td></tr>' ;
}



$array["tenth"] = $_POST['tenth'] ;
$array["twelfth"] = $_POST['puc'] ;
$array["diploma"] = $_POST['dip'] ;

$html_string .= '<tr><td colspan="2">10th :'.$_POST['tenth'].'&#37;</td></tr>' ;
$html_string .= '<tr><td colspan="2">12th :'.$_POST['puc'].'&#37;</td></tr>' ;
$html_string .= '<tr><td colspan="2">Dip  :'.$_POST['dip'].'&#37;</td></tr>' ;

$html_string .= '</table>' ;
$html_string .= '<p>'.$_POST['notes'].'</p>' ;

$json_encoded_details = json_encode($array);

//echo $json_encoded_details ;
//echo '<hr/>' ;
//echo $html_string ;

$form_check = 0 ;

if( isset( $_POST["form_chk"])){ $form_check = 1 ;} 

//echo $form_check ;

$query_string = "INSERT INTO `recruitments` ( `RecId` ,`CompanyName` ,`Status` ,`Details` ,`HTML`,`type`,`notes`,`form`)VALUES (NULL ,  '".$_POST['company_name']."',  '1',  '".$json_encoded_details."',  '".$html_string."' , '". $_POST['type'] ."' , '". $_POST['notes'] ."' , ". $form_check ." )" ;

//echo $query_string ;

mysql_query( $query_string );

$sqll = "SELECT MAX(`RecId`) as `maxrecid` FROM `recruitments`"; 
	$res = mysql_query( $sqll );
	while($row = mysql_fetch_array($res)){
		$maxrecid = $row['maxrecid'];
	}

if ( $form_check == 1 ){ header( 'Location: '.$location.'/admin/gentor.php?r='.$maxrecid ) ; }
else { header( 'Location: '.$location.'/admin/companies.php' ) ; }


?>
