<?php
include_once '../sql.php';

$query_string = "INSERT INTO `form` ( `RecId` ,`form` ) VALUES ( '". $_POST['recid'] ."' ,  '". htmlentities( $_POST['form_html'] , ENT_QUOTES) ."')" ;

echo $query_string ;

mysql_query( $query_string );

header( 'Location: '.$location.'/admin/companies.php' ) ;
?>