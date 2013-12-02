<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>form_gen</title>
	<script type="text/javascript">
	tr_inter = "";
	label = "" ;
	type_of = "" ;
	function addy(){
		val = prompt("Option Value","Type in the value");
		ToAdd += "<input type=\"radio\" name=\""+label+"\" value =\""+val+"\"/>"+val+"<br/>" ;
		if( confirm("Add one more option?\nIf Not please click on 'cancel'.") ){ 
			addy() ;
		}
	}
	function addyt(){
		val = prompt("Option Value","Type in the value");
		ToAdd += "<input type=\"checkbox\" name=\""+label+"\" value =\""+val+"\"/>"+val+"<br/>" ;
		if( confirm("Add one more option?\nIf Not please click on 'cancel'.") ){ 
			addyt() ;
		}
	}
	function nexftm() {
    //toggleEditor('conttent');
	type_of = document.getElementById('TypeOf')[document.getElementById('TypeOf').selectedIndex].value ;
	label = document.getElementById('label').value ;
	original_form = document.getElementById('form_builder').innerHTML ;
	//alert(type_of);alert(label);
    switch (type_of)
    {
        case "Text":
            ToAdd = "<br/>" + label + ": <input type=\"text\" name=\""+label+"\"/>" ;
            break
        case "PassWord":
            ToAdd = "<br/>"+label + ": <input type=\"password\" name=\""+label+"\"/>" ;
            break
        case "FileChoose":
            formtoolbar.innerHTML = "<br/>"+ ftb + "Name: <input type=\"text\" id=\"item_name\"><input type=\"button\" value=\"Save\" onclick=\"Add2Form()\" /> " ;
            break
        case "RadioButton":
            ToAdd = label + ": ";
			addy();
            break
		case "CheckBox":
            ToAdd = "<br/>"+ label + ": ";
			addyt();
            break
        case "DropDown":
            alert("dropdown");
            break
        case "TextArea":
            ToAdd = "<br/>"+ label + ": <textarea name=\""+label+"\"></textarea>" ;
            break
		case "Submit":
            ToAdd = "<br/><input type=\"submit\" value=\""+label+"\"/>" ;
            break
    }
	//alert( document.getElementById("form_viewport").innerHTML + ToAdd ) ;
	document.getElementById("form_viewport").innerHTML += ToAdd ;
    //alert(document.getElementById("conttent").value);
    //obj.innerHTML = ftb2 ;
    //obj.innerHTML = obj.innerHTML + FormToolbar ;
    //toggleEditor('conttent');
	
}

function form_submit(){
	document.getElementById("form_html").value = document.getElementById("form_viewport").innerHTML ;
	val = prompt("Option Value","Type 0 to continue, 1 to cancel");
	if( val == "0" ){ return true; } else { return false; }
}

	</script>
</head>
<body>
	<div id="form_viewport" contenteditable="true">
	
	
	</div>

	<div class="form_builder" id="form_builder">
    <div id="FormToolBar"><input type="text" id="label" Value="Label" onclick="this.value=''"/>&nbsp;<SELECT id="TypeOf" name="TypeOf"><OPTION selected value="Select type of element"><OPTION value="Text">Text</OPTION><OPTION value="PassWord">Password</OPTION><OPTION value="RadioButton">RadioButton</OPTION><OPTION value="DropDown">Dropdown List</OPTION><OPTION value="CheckBox">CheckBox</OPTION><OPTION value="TextArea">textarea</OPTION><OPTION value="Submit">Submit</OPTION></SELECT>&nbsp;<input type="button" value="Add" onclick="nexftm()">
    </div>
	<!-- ending of form builder--></div>
	<form action="gentorsaveform.php" method="POST" onsubmit="return form_submit();">
		<input type="hidden" name="recid" value="<?php echo $_GET["r"]; ?>" />
		<textarea name="form_html" id="form_html" style="display:none;"></textarea>
		<input type="submit" value=" Save! " />
	</form>
</body>
</html>
