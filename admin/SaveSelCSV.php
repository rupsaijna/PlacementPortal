<?php
include "../sql.php";
    function query_to_csv($db_conn, $query, $filename, $attachment = false, $headers = true) {
       
        if($attachment) {
            // send response headers to the browser
            header( 'Content-Type: text/csv' );
            header( 'Content-Disposition: attachment;filename='.$filename);
            $fp = fopen('php://output', 'w');
        } else {
            $fp = fopen($filename, 'w');
        }
       
        $result = mysql_query($query, $db_conn) or die( mysql_error( $db_conn ) );
       
        if($headers) {
            // output header row (if at least one row exists)
            $row = mysql_fetch_assoc($result);
            if($row) {
                fputcsv($fp, array_keys($row));
                // reset pointer back to beginning
                mysql_data_seek($result, 0);
            }
        }
       
        while($row = mysql_fetch_assoc($result)) {
            fputcsv($fp, $row);
        }
       
        fclose($fp);
    }

    // Using the function
    $sql = "SELECT `RegNo`,`Name`,`Email`,`Phno`,`CGPA` from `be_student_details` where `RegNo` in ( select `RegNo` from `students` where `RecId`= ". $_GET["r"] ." and `selected` = 1 )" ;
    $sql .= " UNION ";
    $sql = "SELECT `RegNo`,`Name`,`Email`,`Phno`,`CGPA` from `mt_student_details` where `RegNo` in ( select `RegNo` from `students` where `RecId`= ". $_GET["r"] ." and `selected` = 1 )" ;
    // $db_conn should be a valid db handle

    // output as an attachment
    query_to_csv($con, $sql, "test.csv", true);

    // output to file system
//    query_to_csv($db_conn, $sql, "test.csv", false);
?>
