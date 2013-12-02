<?php
include "../sql.php";
if (!isset($_COOKIE["admin"])){ header("location:".$location."/admin/index.php"); }

function checked_checkbox( $array_name , $should_be_value ) {
	if( !$array_name ){ echo " " ; return True ; }
	if( in_array( $should_be_value , $array_name) ){ echo " checked=\"yes\"";}else{ echo " ";}
}
$r = $_GET['r'] ;
$result = mysql_query( "SELECT * FROM `recruitments` WHERE `RecId`='".$r."'" );
while($row = mysql_fetch_array($result)){

$rec_det = json_decode(  $row['Details'], true );

echo "<br/>";

?>

<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8 />
<title>Student Portal - Edit Company</title>
</head>
<body>
	<b><u>Add Recruitment :</u></b><br/>
	<script>
		function $(y){
			var yy = document.getElementById(y);
			return	yy ;	}

		function toggle(y){ 
			var el = $(y);
			if(el.getAttribute('style')=='display:none'){ el.setAttribute('style',''); }else{el.setAttribute('style','display:none');}
		}

		function hide(y){
			var el = $(y);
			if(el.getAttribute('style')==''){ el.setAttribute('style','display:none'); }
		}

		function show(y){
			var el = $(y);
			if(el.getAttribute('style')=='display:none'){ el.setAttribute('style',''); }
		}
	</script>

	<style type="text/css">
		table
		{
			border-collapse:collapse;
		}
		table, td, th
		{
			border:1px solid black;
		}
		td
		{
			padding:3px;
			vertical-align:top;
		}
		ul {
			list-style-type:none
		}
	</style>

	<form action="edit_company_form_submit.php" method="post">
	<input type="hidden" name="r" value="<?php echo $r ; ?>">
	<table>
		<tr><td colspan="3"><b>Company Name :</b> <input type="text" name="company_name" value="<?php echo $row['CompanyName'] ; ?>"/></td></tr>
		<tr><td colspan="3"><b>Type :</b> 
			<input type="radio" name="type" value="c" <?php if( $row['type'] == "c" ){ echo "checked" ; } ?> >Core 
			<input type="radio" name="type" value="m" <?php if( $row['type'] == "m" ){ echo "checked" ; } ?> >ITES 
			<input type="radio" name="type" value="i" <?php if( $row['type'] == "i" ){ echo "checked" ; } ?> >Internship
			</td>
		</tr>
		<tr>
			<td>
				<input name="level[]" value="be" type="checkbox" <?php checked_checkbox( $rec_det["level"] , "be" ) ?> >Bachelors
			</td>
			<td>
				<input name="level[]" value="me" type="checkbox" <?php checked_checkbox( $rec_det["level"] , "me" ) ?> >Masters
			</td>
			<td>
				<input name="level[]" value="mc" type="checkbox" <?php checked_checkbox( $rec_det["level"] , "mc" ) ?> >MCA
			</td>
		</tr>
          <tr><tr><td colspan="2"><b><u>Branches:</u></b></td><td rowspan="2"></td></tr>
          <tr>
            <td>B.E. Branches
              <table>
                <tr><td><input type="checkbox" name="beb[]"  value="34" <?php checked_checkbox( $rec_det["beb"] , "34" ) ?> >Automobile</td>
					<td><input type="checkbox" name="beb[]"  value="33" <?php checked_checkbox( $rec_det["beb"] , "33" ) ?> >Aeronautical</td></tr>
				<tr><td><input type="checkbox" name="beb[]"  value="02" <?php checked_checkbox( $rec_det["beb"] , "02" ) ?>  >Biomed.</td>
					<td><input type="checkbox" name="beb[]"  value="24" <?php checked_checkbox( $rec_det["beb"] , "24" ) ?> >Biotech.</td></tr>
				<tr><td><input type="checkbox" name="beb[]"  value="04" <?php checked_checkbox( $rec_det["beb"] , "04" ) ?> >Civil</td>
					<td><input type="checkbox" name="beb[]"  value="03" <?php checked_checkbox( $rec_det["beb"] , "03" ) ?> >Chemical</td></tr>
				<tr><td><input type="checkbox" name="beb[]"  value="05" <?php checked_checkbox( $rec_det["beb"] , "05" ) ?> >Computer Sc.</td>
					<td><input type="checkbox" name="beb[]"  value="07" <?php checked_checkbox( $rec_det["beb"] , "07" ) ?> >ECE</td></tr>
                <tr><td><input type="checkbox" name="beb[]"  value="06" <?php checked_checkbox( $rec_det["beb"] , "06" ) ?> >EEE</td>
					<td><input type="checkbox" name="beb[]"  value="21" <?php checked_checkbox( $rec_det["beb"] , "21" ) ?> >ICE</td></tr>
                <tr><td><input type="checkbox" name="beb[]"  value="08" <?php checked_checkbox( $rec_det["beb"] , "08" ) ?> >Ind. Prod.</td>
					<td><input type="checkbox" name="beb[]"  value="11" <?php checked_checkbox( $rec_det["beb"] , "11" ) ?> >IT</td></tr>
                <tr><td><input type="checkbox" name="beb[]"  value="09" <?php checked_checkbox( $rec_det["beb"] , "09" ) ?> >Mechanical</td>
					<td><input type="checkbox" name="beb[]"  value="29" <?php checked_checkbox( $rec_det["beb"] , "29" ) ?> >Mechatronics</td></tr>
                <tr><td><input type="checkbox" name="beb[]"  value="10"  <?php checked_checkbox( $rec_det["beb"] , "10" ) ?>  >Printing</td></tr>
              </table></td>
            
         
            <td>M.Tech. Branches
              <table>
                <tr><td><input type="checkbox" name="meb[]"  value="12" <?php if( isset($rec_det["beb"]) ){ checked_checkbox( $rec_det["beb"] , "12" ); } ?> >Biomed</td>
		    <td><input type="checkbox" name="meb[]"  value="46" <?php if( isset($rec_det["beb"]) ){ checked_checkbox( $rec_det["beb"] , "46" ); } ?> >Biotech.</td></tr>
                <tr><td><input type="checkbox" name="meb[]"  value="49" <?php if( isset($rec_det["beb"]) ){ checked_checkbox( $rec_det["beb"] , "49" ); } ?> >Chem.&nbsp;&nbsp;</td>
		    <td><input type="checkbox" name="meb[]"  value="50" <?php if( isset($rec_det["beb"]) ){ checked_checkbox( $rec_det["beb"] , "50" ); } ?> >Environ.</td></tr>
                <tr><td><input type="checkbox" name="meb[]"  value="18" <?php if( isset($rec_det["beb"]) ){ checked_checkbox( $rec_det["beb"] , "18" ); } ?> >Struct</td>
		    <td><input type="checkbox" name="meb[]"  value="14" <?php if( isset($rec_det["beb"]) ){ checked_checkbox( $rec_det["beb"] , "14" ); } ?> >Construction</td></tr>
                <tr><td><input type="checkbox" name="meb[]"  value="13" <?php if( isset($rec_det["beb"]) ){ checked_checkbox( $rec_det["beb"] , "13" ); } ?> >CSE</td>
		    <td><input type="checkbox" name="meb[]"  value="48" <?php if( isset($rec_det["beb"]) ){ checked_checkbox( $rec_det["beb"] , "48" ); } ?> >Comp.Sc & Info.Sec.</td></tr>
                <tr><td><input type="checkbox" name="meb[]"  value="15" <?php if( isset($rec_det["beb"]) ){ checked_checkbox( $rec_det["beb"] , "15" ); } ?> >DEAC</td>
		    <td><input type="checkbox" name="meb[]"  value="42" <?php if( isset($rec_det["beb"]) ){ checked_checkbox( $rec_det["beb"] , "42" ); } ?> >Micrroele.</td></tr>
                <tr><td><input type="checkbox" name="meb[]"  value="43" <?php if( isset($rec_det["beb"]) ){ checked_checkbox( $rec_det["beb"] , "43" ); } ?> >PESC&nbsp;</td>
		    <td><input type="checkbox" name="meb[]"  value="16" <?php if( isset($rec_det["beb"]) ){ checked_checkbox( $rec_det["beb"] , "16" ); } ?> >EMAL</td></tr>
                <tr><td><input type="checkbox" name="meb[]"  value="44" <?php if( isset($rec_det["beb"]) ){ checked_checkbox( $rec_det["beb"] , "44" ); } ?> >Space</td>
		    <td><input type="checkbox" name="meb[]"  value="25" <?php if( isset($rec_det["beb"]) ){ checked_checkbox( $rec_det["beb"] , "25" ); } ?> >Control Sys.</td></tr>
                <tr><td><input type="checkbox" name="meb[]"  value="27" <?php if( isset($rec_det["beb"]) ){ checked_checkbox( $rec_det["beb"] , "27" ); } ?> >Network</td>
		    <td><input type="checkbox" name="meb[]"  value="28" <?php if( isset($rec_det["beb"]) ){ checked_checkbox( $rec_det["beb"] , "28" ); } ?> >SE</td></tr>
                <tr><td><input type="checkbox" name="meb[]"  value="22" <?php if( isset($rec_det["beb"]) ){ checked_checkbox( $rec_det["beb"] , "22" ); } ?> >CAMDA</td>
		    <td><input type="checkbox" name="meb[]"  value="17" <?php if( isset($rec_det["beb"]) ){ checked_checkbox( $rec_det["beb"] , "17" ); } ?> >Eng. Mangmnt</td></tr>
                <tr><td><input type="checkbox" name="meb[]"  value="26" <?php if( isset($rec_det["beb"]) ){ checked_checkbox( $rec_det["beb"] , "26" ); } ?> >Manufc.</td>
		    <td><input type="checkbox" name="meb[]"  value="30" <?php if( isset($rec_det["beb"]) ){ checked_checkbox( $rec_det["beb"] , "30" ); } ?> >Nuclear</td></tr>
                <tr><td><input type="checkbox" name="meb[]"  value="45" <?php if( isset($rec_det["beb"]) ){ checked_checkbox( $rec_det["beb"] , "45" ); } ?> >Printing</td>
					<td></td><tr>
              </table>
            </td>
            <td></td>
          </tr>
          <tr><td colspan="3"><u><b>Criteria</b></u></td></tr>
          <tr>
            <td>
              <table>
                <tr>
                  <td>
			<input type="radio" onchange="hide('tbl_begpbs')"  name="begp" value="cg" <?php if( isset($rec_det["be_cgpa_choice"]) && $rec_det["be_cgpa_choice"] == "cg" ){ echo "checked" ; } ?> >CGPA:<br/>&nbsp;&nbsp;
					  <input type="text" name="becgpa" size="4" value="<?php if( isset($rec_det["be_cgpa_choice"]) && $rec_det["be_cgpa_choice"] == "cg" ){ echo $rec_det["becgpa"] ; } ?>">
				  </td><td></td><td></td>
                </tr>
                <tr>
                  <td>
					  <input type="radio"  onchange="hide('tbl_begpbs')" name="begp" value="cgps" <?php if(  isset($rec_det["be_cgpa_choice"]) && $rec_det["be_cgpa_choice"] == "cgps" ){ echo "checked" ; } ?> >GPA/Sem:<br/>&nbsp;&nbsp;
					  <input type="text" name="begpaps" size="4" value="<?php if(  isset($rec_det["be_cgpa_choice"]) && $rec_det["be_cgpa_choice"] == "cgps" ){ echo $rec_det["be_gpa"] ; } ?>" >
				  </td>
                  <td>
					  <input type="radio" onchange="hide('tbl_beblbs')"  name="bebl" value="beblt" <?php if(  isset($rec_det["be_bl_choice"]) && $rec_det["be_bl_choice"] == "beblt" ){ echo "checked" ; } ?> >Total BLs:<br/>&nbsp;&nbsp;
					  <input type="text" name="beblt" size="4" value="<?php if( isset($rec_det["be_bl_choice"]) && $rec_det["be_bl_choice"] == "beblt" ){ echo $rec_det["beblt"] ; } ?>">
				  </td>
                  <td>
					  <input type="radio" onchange="hide('tbl_bedcbs')"  name="bedc" value="bedct" <?php if( isset($rec_det["be_dc_choice"]) && $rec_det["be_dc_choice"] == "bedct" ){ echo "checked" ; } ?> >Total DCs:<br/>&nbsp;&nbsp;
					  <input type="text" name="bedct" size="4" value="<?php if(  isset($rec_det["be_dc_choice"]) && $rec_det["be_dc_choice"] == "bedct" ){ echo $rec_det["bedct"] ; } ?>">
				  </td>
                </tr>
                <tr>
                  <td><input type="radio" onchange="show('tbl_begpbs')"  name="begp" value="cgbs"<?php if( isset($rec_det["be_cgpa_choice"]) && $rec_det["be_cgpa_choice"] == "cgbs" ){ echo "checked" ; } ?> >GPA by Sem:<br/>
                    <table style="display:none" id="tbl_begpbs">
                      <tr><td>1</td><td><input type="text" name="begpa[]" size="2" value="<?php if(  isset($rec_det["be_cgpa_choice"]) && $rec_det["be_cgpa_choice"] == "cgbs" ){ echo $rec_det["begpa"][0] ; } ?>"></tr>
                      <tr><td>2</td><td><input type="text" name="begpa[]" size="2" value="<?php if(  isset($rec_det["be_cgpa_choice"]) && $rec_det["be_cgpa_choice"] == "cgbs" ){ echo $rec_det["begpa"][1] ; } ?>"></tr>
                      <tr><td>3</td><td><input type="text" name="begpa[]" size="2" value="<?php if(  isset($rec_det["be_cgpa_choice"]) && $rec_det["be_cgpa_choice"] == "cgbs" ){ echo $rec_det["begpa"][2] ; } ?>"></tr>
                      <tr><td>4</td><td><input type="text" name="begpa[]" size="2" value="<?php if(  isset($rec_det["be_cgpa_choice"]) && $rec_det["be_cgpa_choice"] == "cgbs" ){ echo $rec_det["begpa"][3] ; } ?>"></tr>
                      <tr><td>5</td><td><input type="text" name="begpa[]" size="2" value="<?php if(  isset($rec_det["be_cgpa_choice"]) && $rec_det["be_cgpa_choice"] == "cgbs" ){ echo $rec_det["begpa"][4] ; } ?>"></tr>
                      <tr><td>6</td><td><input type="text" name="begpa[]" size="2" value="<?php if(  isset($rec_det["be_cgpa_choice"]) && $rec_det["be_cgpa_choice"] == "cgbs" ){ echo $rec_det["begpa"][5] ; } ?>"></tr>
                      <tr><td>7</td><td><input type="text" name="begpa[]" size="2" value="<?php if(  isset($rec_det["be_cgpa_choice"]) && $rec_det["be_cgpa_choice"] == "cgbs" ){ echo $rec_det["begpa"][6] ; } ?>"></tr>
                      <tr><td>8</td><td><input type="text" name="begpa[]" size="2" value="<?php if( isset($rec_det["be_cgpa_choice"]) &&  $rec_det["be_cgpa_choice"] == "cgbs" ){ echo $rec_det["begpa"][7] ; } ?>"></tr>
                    </table>
                  </td>
                  <td><input type="radio" onchange="show('tbl_beblbs')"  name="bebl" value="beblbs" <?php if( isset($rec_det["be_bl_choice"]) &&  $rec_det["be_bl_choice"] == "beblbs" ){ echo "checked" ; } ?> >BLs by Sem:<br/>
                    <table style="display:none" id="tbl_beblbs">
                      <tr><td>1</td><td><input type="text" name="bebls[]" size="2" value="<?php if(  isset($rec_det["be_bl_choice"]) && $rec_det["be_bl_choice"] == "beblbs" ){ echo $rec_det["bebls"][0] ; } ?>"></tr>
                      <tr><td>2</td><td><input type="text" name="bebls[]" size="2" value="<?php if( isset($rec_det["be_bl_choice"]) && $rec_det["be_bl_choice"] == "beblbs" ){ echo $rec_det["bebls"][1] ; } ?>"></tr>
                      <tr><td>3</td><td><input type="text" name="bebls[]" size="2" value="<?php if( isset($rec_det["be_bl_choice"]) && $rec_det["be_bl_choice"] == "beblbs" ){ echo $rec_det["bebls"][2] ; } ?>"></tr>
                      <tr><td>4</td><td><input type="text" name="bebls[]" size="2" value="<?php if( isset($rec_det["be_bl_choice"]) && $rec_det["be_bl_choice"] == "beblbs" ){ echo $rec_det["bebls"][3] ; } ?>"></tr>
                      <tr><td>5</td><td><input type="text" name="bebls[]" size="2" value="<?php if( isset($rec_det["be_bl_choice"]) && $rec_det["be_bl_choice"] == "beblbs" ){ echo $rec_det["bebls"][4] ; } ?>"></tr>
                      <tr><td>6</td><td><input type="text" name="bebls[]" size="2" value="<?php if( isset($rec_det["be_bl_choice"]) && $rec_det["be_bl_choice"] == "beblbs" ){ echo $rec_det["bebls"][5] ; } ?>"></tr>
                      <tr><td>7</td><td><input type="text" name="bebls[]" size="2" value="<?php if( isset($rec_det["be_bl_choice"]) && $rec_det["be_bl_choice"] == "beblbs" ){ echo $rec_det["bebls"][6] ; } ?>"></tr>
                      <tr><td>8</td><td><input type="text" name="bebls[]" size="2" value="<?php if( isset($rec_det["be_bl_choice"]) && $rec_det["be_bl_choice"] == "beblbs" ){ echo $rec_det["bebls"][7] ; } ?>"></tr>
                    </table>
                  
                  </td>
                  <td><input type="radio" onchange="show('tbl_bedcbs')"  name="bedc" value="bedcbs" <?php if( isset($rec_det["be_dc_choice"]) && $rec_det["be_dc_choice"] == "bedc" ){ echo "checked" ; } ?> >DCs by Sem:<br/>
                    <table style="display:none" id="tbl_bedcbs">
                      <tr><td>1</td><td><input type="text" name="besdc[]" size="2" value="<?php if( isset($rec_det["be_dc_choice"]) && $rec_det["be_dc_choice"] == "bedcbs" ){ echo $rec_det["besdc"][0] ; } ?>"></tr>
                      <tr><td>2</td><td><input type="text" name="besdc[]" size="2" value="<?php if( isset($rec_det["be_dc_choice"]) && $rec_det["be_dc_choice"] == "bedcbs" ){ echo $rec_det["besdc"][1] ; } ?>"></tr>
                      <tr><td>3</td><td><input type="text" name="besdc[]" size="2" value="<?php if( isset($rec_det["be_dc_choice"]) && $rec_det["be_dc_choice"] == "bedcbs" ){ echo $rec_det["besdc"][2] ; } ?>"></tr>
                      <tr><td>4</td><td><input type="text" name="besdc[]" size="2" value="<?php if( isset($rec_det["be_dc_choice"]) && $rec_det["be_dc_choice"] == "bedcbs" ){ echo $rec_det["besdc"][3] ; } ?>"></tr>
                      <tr><td>5</td><td><input type="text" name="besdc[]" size="2" value="<?php if( isset($rec_det["be_dc_choice"]) && $rec_det["be_dc_choice"] == "bedcbs" ){ echo $rec_det["besdc"][4] ; } ?>"></tr>
                      <tr><td>6</td><td><input type="text" name="besdc[]" size="2" value="<?php if( isset($rec_det["be_dc_choice"]) && $rec_det["be_dc_choice"] == "bedcbs" ){ echo $rec_det["besdc"][5] ; } ?>"></tr>
                      <tr><td>7</td><td><input type="text" name="besdc[]" size="2" value="<?php if( isset($rec_det["be_dc_choice"]) && $rec_det["be_dc_choice"] == "bedcbs" ){ echo $rec_det["besdc"][6] ; } ?>"></tr>
                      <tr><td>8</td><td><input type="text" name="besdc[]" size="2" value="<?php if( isset($rec_det["be_dc_choice"]) && $rec_det["be_dc_choice"] == "bedcbs" ){ echo $rec_det["besdc"][7] ; } ?>"></tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
            <td>
                            <table>
                <tr>
					<td>
						<input type="radio" onchange="hide('tbl_megpbs')"   name="megp" value="cg"  
<?php if( $rec_det["me_cgpa_choice"] == "cg" ){ echo "checked" ; } ?> 
>CGPA:<br/>&nbsp;&nbsp;
						<input type="text"  name="mecgpa" size="4" value="
<?php if( isset($rec_det["mecgpa"]) && $rec_det["me_cgpa_choice"] == "cg" ){ echo $rec_det["mecgpa"] ; } ?>
">
					</td><td></td><td></td>
                </tr>
                <tr>
                  <td><input type="radio" onchange="hide('tbl_megpbs')"   name="megp" value="cgps" <?php if( $rec_det["me_cgpa_choice"] == "cgps" ){ echo "checked" ; } ?> >GPA/Sem:<br/>&nbsp;&nbsp;
				  <input type="text" name="megpaps" size="4" value"
<?php if( isset($rec_det["megpaps"]) && $rec_det["me_cgpa_choice"] == "cgps" ){ echo $rec_det["megpaps"] ; } ?>
"></td>
                  <td><input type="radio" onchange="hide('tbl_meblbs')"   name="mebl" value="meblt" >Total BLs:<br/>&nbsp;&nbsp;<input type="text" name="meblt" size="4" value=""></td>
                  <td><input type="radio" onchange="hide('tbl_medcbs')"   name="medc" value="medct">Total DCs:<br/>&nbsp;&nbsp;<input type="text" name="medct" size="4" value="0"></td>
                </tr>
                <tr>
                  <td><input type="radio" onchange="show('tbl_megpbs')"  name="megp" value="cgbs"<?php if( $rec_det["me_cgpa_choice"] == "cgbs" ){ echo "checked" ; } ?>>GPA by Sem:<br/>
                    <table style="display:none" id="tbl_megpbs">
                      <tr><td>1</td><td><input type="text" name="megpa[]" size="2"></tr>
                      <tr><td>2</td><td><input type="text" name="megpa[]" size="2"></tr>
                      <tr><td>3</td><td><input type="text" name="megpa[]" size="2"></tr>
                      <tr><td>4</td><td><input type="text" name="megpa[]" size="2"></tr>
                    </table>
                  </td>
                  <td><input type="radio" onchange="show('tbl_meblbs')"  name="mebl" value="mebls">BLs by Sem:<br/>
                    <table style="display:none" id="tbl_meblbs">
                      <tr><td>1</td><td><input type="text" name="mebls[]" size="2" value="0"></tr>
                      <tr><td>2</td><td><input type="text" name="mebls[]" size="2" value="0"></tr>
                      <tr><td>3</td><td><input type="text" name="mebls[]" size="2" value="0"></tr>
                      <tr><td>4</td><td><input type="text" name="mebls[]" size="2" value="0"></tr>
                    </table>
                  
                  </td>
                  <td><input type="radio" onchange="show('tbl_medcbs')" name="medc" value="medcs">DCs by Sem:<br/>
                    <table style="display:none" id="tbl_medcbs">
                      <tr><td>1</td><td><input type="text" name="medcs[]" size="2" value="0"></tr>
                      <tr><td>2</td><td><input type="text" name="medcs[]" size="2" value="0"></tr>
                      <tr><td>3</td><td><input type="text" name="medcs[]" size="2" value="0"></tr>
                      <tr><td>4</td><td><input type="text" name="medcs[]" size="2" value="0"></tr>

                    </table>
                  </td>
                </tr>
              </table>
            </td>
            <td>
              <table>
                <tr>
                  <td>
					<input type="radio" onchange="hide('tbl_mcgpbs')" name="mcgp" value="cg">CGPA:<br/>&nbsp;&nbsp;
					<input type="text" name="mccgpa" size="4"></td><td></td><td></td>
                </tr>
                <tr>
                  <td>
					<input type="radio" onchange="hide('tbl_mcgpbs')" name="mcgp" value="cgps">GPA/Sem:<br/>&nbsp;&nbsp;
					<input type="text" name="mcgpaps" size="4"></td>
                  <td><input type="radio" onchange="hide('tbl_mcblbs')" name="mcbl" value="mcblt">Total BLs:<br/>&nbsp;&nbsp;<input type="text" name="mcblt" size="4" value="0"></td>
                  <td><input type="radio" onchange="hide('tbl_mcdcbs')" name="mcdc" value="mcdct">Total DCs:<br/>&nbsp;&nbsp;<input type="text" name="mcdct" size="4" value="0"></td>
                </tr>
                <tr>
                  <td><input onchange="show('tbl_mcgpbs')"  type="radio" name="mcgp" value="cgbs">GPA by Sem:<br/>
                    <table style="display:none" id="tbl_mcgpbs">
                      <tr><td>1</td><td><input type="text" name="mcgpa[]" size="2"></tr>
                      <tr><td>2</td><td><input type="text" name="mcgpa[]" size="2"></tr>
                      <tr><td>3</td><td><input type="text" name="mcgpa[]" size="2"></tr>
                      <tr><td>4</td><td><input type="text" name="mcgpa[]" size="2"></tr>
                    </table>
                  </td>
                  <td><input onchange="show('tbl_mcblbs')"  type="radio" name="mcbl" value="mcbls">BLs by Sem:<br/>
                    <table style="display:none" id="tbl_mcblbs">
                      <tr><td>1</td><td><input type="text" name="mcbls[]" size="2" value="0"></tr>
                      <tr><td>2</td><td><input type="text" name="mcbls[]" size="2" value="0"></tr>
                      <tr><td>3</td><td><input type="text" name="mcbls[]" size="2" value="0"></tr>
                      <tr><td>4</td><td><input type="text" name="mcbls[]" size="2" value="0"></tr>
                    </table>
                  
                  </td>
                  <td><input onchange="show('tbl_mcdcbs')"  type="radio" name="mcdc" value="mcdcs">DCs by Sem:<br/>
                    <table style="display:none" id="tbl_mcdcbs">
                      <tr><td>1</td><td><input type="text" name="mcdcs[]" size="2" value="0"></tr>
                      <tr><td>2</td><td><input type="text" name="mcdcs[]" size="2" value="0"></tr>
                      <tr><td>3</td><td><input type="text" name="mcdcs[]" size="2" value="0"></tr>
                      <tr><td>4</td><td><input type="text" name="mcdcs[]" size="2" value="0"></tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>

          </tr>
	  <tr><td colspan="3">10 :<input type="text" name="tenth" id="" value="<?php echo $rec_det["tenth"] ; ?>" /></td></tr>
	  <tr><td colspan="3">12 :<input type="text" name="puc" id="" value="<?php echo $rec_det["twelfth"] ; ?>" /></td></tr>
	  <tr><td colspan="3">Diploma :<input type="text" name="dip" id="" value="<?php echo $rec_det["diploma"] ; ?>" /></td></tr>
	  <tr><td colspan="3"><b>Note (if any): </b><textarea name="notes" cols="150"><?php echo $row["notes"] ; ?></textarea></tr>
          <tr><td colspan="3"><input type="submit" value="Save"></tr>
        </table>
  </form>
<?php

}

?>
</body>
</html>


