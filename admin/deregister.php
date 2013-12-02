<?php
include "../sql.php";
mysql_query( "delete from `students` where `rstuid`=".$_GET['r'] );
header( 'Location: '.$location.'/admin/students.php?r='.$_GET['s'] ) ;
?>