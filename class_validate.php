<?php

class validation{

	public $studentId ;
	public $companyId ;
	public $course ;
	public $message ; // in case of validation failure.
	public $rec_details ; //should be private in production.
	public $rec_status ;
	public $stu_details ;
	public $level ;
	public $type ;
	public $form_presence ;
	
	function __construct($stuid,$compid) {
		
		$this->studentID = (string) $stuid ;
		if( strlen( $this->studentID ) == 8 ){ $this->studentID = "0".$this->studentID ; }
		$this->course = $this->return_level() ;
		//echo $stuid ;
		//echo $this->studentID[4].$this->studentID[5] ;
		$this->companyID = $compid ;
		$this->get_rec_specs() ;
		$this->get_stu_dets() ;
	}
	
	private function get_rec_specs(){
		//use $this->companyID in sql, extract the json file and save in $rec_details.
		$row = query_database("SELECT * from `recruitments` where `Recid`=".$this->companyID ) ;
		$this->rec_status = $row['Status'] ;
		$this->rec_details = json_decode(  $row['Details'], true );
		$this->type = $row['type'] ;
		$this->form_presence = $row['form'] ;
	}
	
	private function get_stu_dets(){
		switch($this->course) {
			case "be":
				$this->stu_details = query_database("SELECT * FROM be_student_details where `RegNo`=".$this->studentID ) ;
				break;
			case "me":
			case "mc":
				$this->stu_details = query_database("SELECT * FROM mt_student_details where `RegNo`=".$this->studentID ) ;
				break;
		}
		//use $this->companyID in sql, extract the json file and save in $stu_details.
		
		//var_dump($this->stu_details);
		
	}
	
	private function already_registered(){
		$result = mysql_query("SELECT * FROM `students` WHERE `RegNo` = ".$this->studentID." AND `RecId` = ".$this->companyID ) ;
		$no_rows = mysql_num_rows( $result );
		if( $no_rows != 0 ){ $this->message = "Already Registered" ; return False ; }
		return True ;
	}
	
	// validate branch, level , cgpa , bl's , dc's 
	// all the validate_* functions will return a true or false based on the test.
	
	private function validate_status(){
		//echo $this->rec_status ;
		if( $this->rec_status == 1 ){ 
			$this->message = "Enrolment is closed" ;
			return False ;
		} else if( $this->rec_status == 2 ) {
			$this->message = "Recruitement is closed" ;
			return False ;
		} else {
			return True ;
		}	
	}
	
	private function validate_branch(){
	
		if( !in_array( $this->studentID[4].$this->studentID[5] , $this->rec_details["beb"] ) ){ //in_Array fn goes here.
			$this->message = "Your Branch is not allowed" ;
			return False ;
		}
		return True ;
	}
	
	private function validate_type(){
		if( $this->stu_details['allowed_all'] == 1 ){ 
			$this->message = "Not Allowed." ;
			return False ;
		}
		
		if( $this->stu_details['allowed_pc'] == 1 ){ 
			$this->message = "Already placed in Prefered Company." ;
			return False ;
		}
	
		if( $this->type == "c" && $this->stu_details['allowed_core'] == 1 ){ 
			$this->message = "Already placed in a Core company. Please Contact office if this is your preferred company." ;
			return False ;
		}
		if( $this->type == "i" && $this->stu_details['allowed_internship'] == 1 ){
			$this->message = "Already placed for internship." ;
			return False ;
		}
		return True ;
	}
	
	private function return_level(){
		
		$stubranch = $this->studentID[4].$this->studentID[5] ;
		
		if ( in_array( $stubranch , array(34,33,02,04,24,03,05,06,07,21,8,11,9,29,10) ) ){ return "be"; }

		if ( in_array( $stubranch , array(12,46,49,50,18,14,13,48,15,42,43,16,44,25,27,28,22,17,26,30,45) ) ){return "me" ;}
		
		if ( in_array( $stubranch , array(19) ) ){return "mc" ;}
	}
	
	
	private function validate_cgpa(){
		if( $this->stu_details['CGPA'] <s $this->rec_details['becgpa'] ){
			$this->message = "Insufficient CGPA" ;
			return False ;
		}
		return True ;
	}
	
	private function validate_gpa_per_sem(){
		if( $this->stu_details['GPA1'] < $this->rec_details["begpaps"] ){
			$this->message = "Insufficient GPA in Semester 1" ;
			return False ;
		}
		if( $this->stu_details['GPA2'] < $this->rec_details["begpaps"] ){
			$this->message = "Insufficient GPA in Semester 2" ;
			return False ;
		}
		if( $this->stu_details['GPA3'] < $this->rec_details["begpaps"] ){
			$this->message = "Insufficient GPA in Semester 3" ;
			return False ;
		}
		if( $this->stu_details['GPA4'] < $this->rec_details["begpaps"] ){
			$this->message = "Insufficient GPA in Semester 4" ;
			return False ;
		}
		if( $this->stu_details['GPA5'] < $this->rec_details["begpaps"] ){
			$this->message = "Insufficient GPA in Semester 5" ;
			return False ;
		}
		if( $this->stu_details['GPA6'] < $this->rec_details["begpaps"] ){
			$this->message = "Insufficient GPA in Semester 6" ;
			return False ;
		}
		if( $this->stu_details['GPA7'] < $this->rec_details["begpaps"] ){
			$this->message = "Insufficient GPA in Semester 7" ;
			return False ;
		}
		if( $this->stu_details['GPA8'] < $this->rec_details["begpaps"] ){
			$this->message = "Insufficient GPA in Semester 8" ;
			return False ;
		}
		return True ;
	}
	
	private function validate_gpa_by_sem(){
		if( $this->stu_details['GPA1'] < $this->rec_details["begpa"][0] ){
			$this->message = "Insufficient GPA in Semester 1" ;
			return False ;
		}
		if( $this->stu_details['GPA2'] < $this->rec_details["begpa"][1] ){
			$this->message = "Insufficient GPA in Semester 2" ;
			return False ;
		}
		if( $this->stu_details['GPA3'] < $this->rec_details["begpa"][2] ){
			$this->message = "Insufficient GPA in Semester 3" ;
			return False ;
		}
		if( $this->stu_details['GPA4'] < $this->rec_details["begpa"][3] ){
			$this->message = "Insufficient GPA in Semester 4" ;
			return False ;
		}
		if( $this->stu_details['GPA5'] < $this->rec_details["begpa"][4] ){
			$this->message = "Insufficient GPA in Semester 5" ;
			return False ;
		}
		if( $this->stu_details['GPA6'] < $this->rec_details["begpa"][5] ){
			$this->message = "Insufficient GPA in Semester 6" ;
			return False ;
		}
		if( $this->stu_details['GPA7'] < $this->rec_details["begpa"][6] ){
			$this->message = "Insufficient GPA in Semester 7" ;
			return False ;
		}
		if( $this->stu_details['GPA8'] < $this->rec_details["begpa"][7] ){
			$this->message = "Insufficient GPA in Semester 8" ;
			return False ;
		}
		return True ;
	}
	
	private function validate_gpa(){
		//var_dump($this->rec_details);
		$cgpa_choice = $this->rec_details["be_cgpa_choice"] ;
		switch ($cgpa_choice) {
			case "cg":
				if( $this->validate_cgpa() == False ){ return False; };
				break;
			case "cgps":
				if( $this->validate_gpa_per_sem() == False ){ return False; };
				break;
			case "cgbs":
				if( $this->validate_gpa_by_sem() == False ){ return False; };
				break;
		}
		return True ;
	}

	private function validate_me_cgpa(){
		if( $this->stu_details['CGPA'] == $this->rec_details['mecgpa'] ){
			$this->message = "Insufficient CGPA" ;
			return False ;
		}
		return True ;
	}
	
	private function validate_me_gpa_per_sem(){
		if( $this->stu_details['GPA1'] < $this->rec_details["megpaps"] ){
			$this->message = "Insufficient GPA in Semester 1" ;
			return False ;
		}
		if( $this->stu_details['GPA2'] < $this->rec_details["megpaps"] ){
			$this->message = "Insufficient GPA in Semester 2" ;
			return False ;
		}
		if( $this->stu_details['GPA3'] < $this->rec_details["megpaps"] ){
			$this->message = "Insufficient GPA in Semester 3" ;
			return False ;
		}
		if( $this->stu_details['GPA4'] < $this->rec_details["megpaps"] ){
			$this->message = "Insufficient GPA in Semester 4" ;
			return False ;
		}
		return True ;
	}
	
	private function validate_me_gpa_by_sem(){
		if( $this->stu_details['GPA1'] < $this->rec_details["megpa"][0] ){
			$this->message = "Insufficient GPA in Semester 1" ;
			return False ;
		}
		if( $this->stu_details['GPA2'] < $this->rec_details["megpa"][1] ){
			$this->message = "Insufficient GPA in Semester 2" ;
			return False ;
		}
		if( $this->stu_details['GPA3'] < $this->rec_details["megpa"][2] ){
			$this->message = "Insufficient GPA in Semester 3" ;
			return False ;
		}
		if( $this->stu_details['GPA4'] < $this->rec_details["megpa"][3] ){
			$this->message = "Insufficient GPA in Semester 4" ;
			return False ;
		}
	
		return True ;
	}
	
	private function validate_me_gpa(){
		//var_dump($this->rec_details);
		$cgpa_choice = $this->rec_details["me_cgpa_choice"] ;
		switch ($cgpa_choice) {
			case "cg":
				if( $this->validate_me_cgpa() == False ){ return False; };
				break;
			case "cgps":
				if( $this->validate_me_gpa_per_sem() == False ){ return False; };
				break;
			case "cgbs":
				if( $this->validate_me_gpa_by_sem() == False ){ return False; };
				break;
		}
		return True ;
	}

	
	private function validate_backlogs(){
		$bl_choice = $this->rec_details["be_bl_choice"] ;
		switch ($bl_choice) {
			case "beblt":
				if( $this->validate_bls() == False ){ return False; };
				break;
			case "beblbs":
				if( $this->validate_bls_sem() == False ){ return False; };
				break;
		}
		return True ;
	}
	
	private function validate_datechange(){
		$dc_choice = $this->rec_details["be_dc_choice"] ;
		switch ($dc_choice) {
			case "bedct":
				if( $this->validate_dc() == False ){ return False; };
				break;
			case "bedcbs":
				if( $this->validate_dc_sem() == False ){ return False; };
				break;
		}
		return True ;
	}
	
	
	private function validate_me_backlogs(){
		$bl_choice = $this->rec_details["me_bl_choice"] ;
		switch ($bl_choice) {
			case "meblt":
				if( $this->validate_me_bls() == False ){ return False; };
				break;
			case "meblbs":
				if( $this->validate_me_bls_sem() == False ){ return False; };
				break;
		}
		return True ;
	}
	
	private function validate_me_datechange(){
		$dc_choice = $this->rec_details["me_dc_choice"] ;
		switch ($dc_choice) {
			case "medct":
				if( $this->validate_me_dc() == False ){ return False; };
				break;
			case "medcbs":
				if( $this->validate_me_dc_sem() == False ){ return False; };
				break;
		}
		return True ;
	}
	
	
	private function validate_bls(){
		if( $this->stu_details['TBL'] > $this->rec_details["beblt"] ){
			$this->message = "More BL's than allowed" ;
			return False ;
		}
		return True ;
	}
	
	private function validate_bls_sem(){
		if( $this->stu_details['BL1'] > $this->rec_details["beblbs"][0] ){
			$this->message = "More BL in Sem 1 than allowed" ;
			return False ;
		}
		if( $this->stu_details['BL2'] > $this->rec_details["beblbs"][1] ){
			$this->message = "More BL in Sem 2 than allowed" ;
			return False ;
		}
		if( $this->stu_details['BL3'] > $this->rec_details["beblbs"][2] ){
			$this->message = "More BL in Sem 3 than allowed" ;
			return False ;
		}
		if( $this->stu_details['BL4'] > $this->rec_details["beblbs"][3] ){
			$this->message = "More BL in Sem 4 than allowed" ;
			return False ;
		}
		if( $this->stu_details['BL5'] > $this->rec_details["beblbs"][4] ){
			$this->message = "More BL in Sem 5 than allowed" ;
			return False ;
		}
		if( $this->stu_details['BL6'] > $this->rec_details["beblbs"][5] ){
			$this->message = "More BL in Sem 6 than allowed" ;
			return False ;
		}
		if( $this->stu_details['BL7'] > $this->rec_details["beblbs"][6] ){
			$this->message = "More BL in Sem 7 than allowed" ;
			return False ;
		}
		if( $this->stu_details['BL8'] > $this->rec_details["beblbs"][7] ){
			$this->message = "More BL in Sem 8 than allowed." ;
			return False ;
		}
		return True ;
		
	}
	
	private function validate_dc(){
		if( $this->stu_details['TSP'] > $this->rec_details["bedct"] ){
			$this->message = "More DC than allowed." ;
			return False ;
		}
		return True ;
		
	}
	
	private function validate_bachelors(){
		if( $this->stu_details['MB'] < $this->rec_details["b_cgp"] ){
			$this->message = "Less marks in Bachelors than needed." ;
			return False ;
		}
		return True ;
	}
	
	private function validate_dc_sem(){
		 ;
		if( $this->stu_details['SP1'] == $this->rec_details["bedcbs"][0] ){
			$this->message = "More DC in Sem 1 than allowed." ;
			return False ;
		}
		if( $this->stu_details['SP2'] == $this->rec_details["bedcbs"][1] ){
			$this->message = "More DC in Sem 2 than allowed." ;
			return False ;
		}
		if( $this->stu_details['SP3'] == $this->rec_details["bedcbs"][2] ){
			$this->message = "More DC in Sem 3 than allowed." ;
			return False ;
		}
		if( $this->stu_details['SP4'] == $this->rec_details["bedcbs"][3] ){
			$this->message = "More DC in Sem 4 than allowed." ;
			return False ;
		}
		if( $this->stu_details['SP5'] == $this->rec_details["bedcbs"][4] ){
			$this->message = "More DC in Sem 5 than allowed." ;
			return False ;
		}
		if( $this->stu_details['SP6'] == $this->rec_details["bedcbs"][5] ){
			$this->message = "More DC in Sem 6 than allowed." ;
			return False ;
		}
		if( $this->stu_details['SP7'] == $this->rec_details["bedcbs"][6] ){
			$this->message = "More DC in Sem 7 than allowed." ;
			return False ;
		}
		if( $this->stu_details['SP8'] == $this->rec_details["bedcbs"][7] ){
			$this->message = "More DC in Sem 8 than allowed." ;
			return False ;
		}
		return True ;
		
	}

// mtech s

private function validate_me_bls(){
		if( $this->stu_details['TBL'] > $this->rec_details["meblt"] ){
			$this->message = "More BL's than allowed." ;
			return False ;
		}
		return True ;
	}
	
	private function validate_me_bls_sem(){
		if( $this->stu_details['BL1'] > $this->rec_details["meblbs"][0] ){
			$this->message = "More BL in Sem 1 than allowed." ;
			return False ;
		}
		if( $this->stu_details['BL2'] > $this->rec_details["meblbs"][1] ){
			$this->message = "More BL in Sem 2 than allowed." ;
			return False ;
		}
		if( $this->stu_details['BL3'] > $this->rec_details["meblbs"][2] ){
			$this->message = "More BL in Sem 3 than allowed." ;
			return False ;
		}
		if( $this->stu_details['BL4'] > $this->rec_details["meblbs"][3] ){
			$this->message = "More BL in Sem 4 than allowed." ;
			return False ;
		}
		return True ;
		
	}
	
	private function validate_me_dc(){
		if( $this->stu_details['TSP'] > $this->rec_details["medct"] ){
			$this->message = "More DC than allowed" ;
			return False ;
		}
		return True ;
		
	}
	
	private function validate_me_dc_sem(){
		 ;
		if( $this->stu_details['SP1'] == $this->rec_details["medcbs"][0] ){
			$this->message = "More DC in Sem 1 than allowed" ;
			return False ;
		}
		if( $this->stu_details['SP2'] == $this->rec_details["medcbs"][1] ){
			$this->message = "More DC in Sem 2 than allowed" ;
			return False ;
		}
		if( $this->stu_details['SP3'] == $this->rec_details["medcbs"][2] ){
			$this->message = "More DC in Sem 3 than allowed" ;
			return False ;
		}
		if( $this->stu_details['SP4'] == $this->rec_details["medcbs"][3] ){
			$this->message = "More DC in Sem 4 than allowed" ;
			return False ;
		}
		if( $this->stu_details['SP5'] == $this->rec_details["medcbs"][4] ){
			$this->message = "More DC in Sem 5 than allowed" ;
			return False ;
		}
		return True ;
		
	}



// mtech e
	
	function validate_test(){
		// return true for validated
		// return false if not validated Also check this->messsage for reason validation failed
		
		if($this->validate_type() == False){return False;}
		
		if($this->already_registered() == False){return False;}
		
		// chk status
		if($this->validate_status() == False){return False;}
//		echo "sta";
		// chk branch
		if($this->validate_branch() == False){return False;}
	//	echo "bra";
	
		switch ($this->course) {
			case "be" :
				// chk gpa type
				if($this->validate_gpa() == False){return False;}
				//echo "gpa";
				// chk bl
				if($this->validate_backlogs() == False){return False;}
				//echo "bl";
				// chk dc
				if($this->validate_datechange() == False){return False;}
				break ;
			case "me" :
				if($this->validate_me_gpa() == False){return False;}
				//echo "gpa";
				// chk bl
				if($this->validate_me_backlogs() == False){return False;}
				//echo "bl";
				// chk dc
				if($this->validate_me_datechange() == False){return False;}
				if($this->validate_bachelors() == False){return False;}
				break ;
			case "mc" :
				if($this->validate_mc_gpa() == False){return False;}
				//echo "gpa";
				// chk bl
				if($this->validate_mc_backlogs() == False){return False;}
				//echo "bl";
				// chk dc
				if($this->validate_mc_datechange() == False){return False;}
				if($this->validate_bachelors() == False){return False;}
				
				break ;
				
		}
				//echo "dc";
		//echo $this->studentID ;
		//echo $this->companyID ;
		//echo $sqll,'<br/>' ;
		$this->message = "Validated! Will be succesfully registered.";
		
		return True;
	}
	


	
	function validate( $form_value ){
		// return true for validated
		// return false if not validated Also check this->messsage for reason validation failed
		
		if($this->validate_type() == False){return False;}
		
		if($this->already_registered() == False){return False;}
		
		// chk status
		if($this->validate_status() == False){return False;}
//		echo "sta";
		// chk branch
		if($this->validate_branch() == False){return False;}
	//	echo "bra";
	
		switch ($this->course) {
			case "be" :
				// chk gpa type
				if($this->validate_gpa() == False){return False;}
				//echo "gpa";
				// chk bl
				if($this->validate_backlogs() == False){return False;}
				//echo "bl";
				// chk dc
				if($this->validate_datechange() == False){return False;}
				break ;
			case "me" :
				if($this->validate_me_gpa() == False){return False;}
				//echo "gpa";
				// chk bl
				if($this->validate_me_backlogs() == False){return False;}
				//echo "bl";
				// chk dc
				if($this->validate_me_datechange() == False){return False;}
				if($this->validate_bachelors() == False){return False;}
				break ;
			case "mc" :
				if($this->validate_mc_gpa() == False){return False;}
				//echo "gpa";
				// chk bl
				if($this->validate_mc_backlogs() == False){return False;}
				//echo "bl";
				// chk dc
				if($this->validate_mc_datechange() == False){return False;}
				if($this->validate_bachelors() == False){return False;}
				
				break ;
				
		}
				//echo "dc";
		//echo $this->studentID ;
		//echo $this->companyID ;
		$sqll = "INSERT INTO `students` (`rstuid`, `RegNo`, `RecId` , `type`,`form_value`) VALUES (NULL, '". $this->studentID ."',' ". $this->companyID  ."','".$this->type."','". $form_value ."')" ;
		//echo $sqll,'<br/>' ;
		if( !mysql_query($sqll))
		{
			$this->message = 'Error: '. mysql_error();
		}
		else
		{
			$this->message = "<br/>Registered!";
		}
		
		return True;
	}
	
	function validate_relax($form_values){
	
	/*
		will check only whether candidate is already registered or suitable branch
	*/
	
		// return true for validated
		// return false if not validated Also check this->messsage for reason validation failed
		
		if($this->validate_type() == False){return False;}
		
		if($this->already_registered() == False){return False;}
		// chk status
		// chk branch
		if($this->validate_branch() == False){return False;}

		
		$sqll = "INSERT INTO `students` (`rstuid`, `RegNo`, `RecId`,`type`,`form_value`) VALUES (NULL, '". $this->studentID ."',' ". $this->companyID  ."','". $this->type ."','". $form_values ."')" ;
		//echo $sqll,'<br/>' ;
		if( !mysql_query($sqll))
		{
			$this->message = 'Error: '. mysql_error();
		}
		else
		{
			$this->message = "Registered!";
		}
		
		return True;
	}

}




?>

