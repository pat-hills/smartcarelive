<!-- <?php

// $host="localhost";
// $user="root";
// $pass="";
// $db="vim";

// session_start();

// @mysql_connect($host,$user,$pass);

// @mysql_select_db($db);


// if(isset($_POST['uname']) && isset($_POST['pass1']) && isset($_POST['pass2']) && isset($_POST['utype'])){

// 	if($_POST['pass1'] ==$_POST['pass2']){

// 			$string="THstaff";

// 			$sql1="SELECT COUNT(*) FROM tbl_login";
// 			$query=mysql_query($sql1);
// 			$answer= mysql_result($query, 0);

// 			$staffID=$string.$answer;
// 			$pass1=md5($_POST['pass2']);

// 			$sql= "INSERT INTO tbl_login (userid,uname,pass,acc_lvl) VALUES
// 			('".$staffID."','".$_POST['uname']."','".$pass1."','".$_POST['utype']."')";
// 			if($reg=mysql_query($sql)){
// 				echo "Registration Complete";
// 				$sql="INSERT INTO tbl_staff (staff_id,firstName,otherNames) 
// 				VALUES ('".$staffID."','".$_POST['fname']."','".$_POST['oname']."')";
// 				if($asd =mysql_query($sql)){
// 					//echo "lol";
// 				}else{
// 					echo "error ".mysql_error();
// 				}

// 			}else{
// 				echo "Registration error ".mysql_error();
// 			}
// 	}else{
// 		echo "Passwords need matching";
// 	}
// }else{
// 	echo "All fields are required";
// }
?>
<html>
	<head>
		<title>Stuff Registration</title>
	</head>

<body>
			<form name="adduser" method="post" action="reg.php">
			<legend>
				Username: <input type="text" name="uname" required="true"/><br />

				Password: <input type="text" name="pass1" required="true"/><br />
				Re-Password: <input type="text" name="pass2" required="true"><br />
				User Type: <select name="utype" required="true">
					<option value="">..Select User type Below...</option>
					<option value="2">Prescriber</option>
					<option value="3">OPD</option>
					<option value="6">Pharmacy</option>
					<option value="5">Records</option>
					
				</select><br />
				First Name: <input type="text" name="fname" required="true"/><br />

				Other Names: <input type="text" name="oname" required="true"/><br />

				<input type="submit" name="Register">
				</legend>
			</form>

</body>





</html> -->