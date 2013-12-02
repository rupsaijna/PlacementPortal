<div class="dp100" style="border-bottom:1px solid #000;">
<ul class="navl">

<?php
		$token_len = 6 ;
		$token = "";
		$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
		$codeAlphabet.= "0123456789";
		for($i=0;$i<$token_len;$i++){
			do {
				$rnd = hexdec(bin2hex(openssl_random_pseudo_bytes(1)));
				$rnd = $rnd & 63; // discard irrelevant bits
			} while ($rnd >= 62);

			$token .= $codeAlphabet[ $rnd ];
		}
		$q = $token;
?>

<li><a href="student_companies.php<?php echo "?z=".$q ;?>">Home</a></li>
<li><a href="student.php<?php echo "?z=".$q ;?>"">Details</a></li>
<li><a href="student_reg_companies.php<?php echo "?z=".$q ;?>"">Registered For</a></li>
</ul>

<ul class="navr">
<li><a href="change_pwd.php<?php echo "?z=".$q ;?>"">Change Password</a></li>
<li><a href="logout.php<?php echo "?z=".$q ;?>"">Logout</a></li>
</ul>

</div>
