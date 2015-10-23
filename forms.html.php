<?php 
include_once "boot.php";
?>
<!DOCTYPE html>
<html>
<!--FIRST PAGE WITH SIGN UP AND SIGN IN-->
<head>
	<title>RECOMMENDATION SYSTEM</title>
	<style type="text/css">
		table td{
			padding:5px;
		}
	</style>
	<script type="text/javascript">
		function signupchk () {
			var pwd = document.getElementById('i5');
			if(pwd.value.length<8){
				pwd.style.border="1px solid red";
				return false;
			}
			else{
				pwd.style.border="1px solid silver";
				var cpwd=document.getElementById('i6');
				if(pwd.value!=cpwd.value){
					document.getElementById('cpwd').innerHTML="Passwords do not match";
				return false;
			}
			else
				document.getElementById('cpwd').innerHTML="";
		}
		
		var name=document.getElementById('i1');
		for(var x in name.value)
		{
			if(!((name.value[x]>='A'&&name.value[x]<='Z')||(name.value[x]>='a'&&name.value<='z')))
			{
				name.style.border="1px solid red";
				document.getElementById('s1').innerHTML="Name should contain only letters";
				return false;
			}
			else
			{
				name.style.border="1px solid silver";
				document.getElementById('s1').innerHTML="";
			}
		}

		var mobile=document.getElementById('i7');
		for(var z in mobile.value)
		{
			if(!(mobile.value[z]>='0'&&mobile.value[z]<=9))
			{
				mobile.style.border="1px solid red";
				document.getElementById('mob').innerHTML="Mobile Number is a numeric field";
				return false;
			}
			else
			{
				mobile.style.border="1px solid silver";
				document.getElementById('mob').innerHTML="";
			}
		}

	}
	</script>
</head>
<body style="background-color:#420021">
	<div>
		<?php error_reporting(0);?>
		<span style="color:red; font-size:15px;"><?php {echo $_GET['err'];}?></span>
		<span style="color:green; font-size:15px;"><?php {echo $_GET['msg'];}?></span>
	</div>

	<table style="color:#FFFFFF; font-family:Papyrus; font-size:18px">
		<tr>
			<td width="700" height="100">
				<img src="accessitlogo.jpg" width="250px"><!--ACCESS IT LOGO-->

			</td>
			<td>
				<form action="loginchk.php" method="post">
				<table>
					<tr><td col = "3" style="font-family:Arial; font-size:25px;"> LOGIN </td></tr>
					<tr>
						<td>Username</td>
						<td>Password</td>
					</tr>
					<tr>
						<td>
							<input type="textbox" required name="username" id="l1" style="color:black;">
						</td>
						<td>
							<input type="password" required name="password" id="l2" style="color:black;">
						</td>
						<td>
							<button class="btn btn-default btn-sm"><b>ACCESS!</b></button>
						</td>
					</tr>
				</table>
				</form>
			</td>
		</tr>
		<tr>
			<td height="400">
				<span style="font-family:Papyrus; font-size:25px">
				Back up your contacts here!<br><br>
				No more worries on losing your phone or battery low issues!<br><br>
				Call anyone, from anywhere!<br> Look up your contacts from even a remote computer!<br><br><!--ACCESS IT ADV-->
			</span>
			</td>
			<td>
				<form action="signup.php" method="post" onsubmit="return signupchk();">
				<table>
					<tr>
						<td colspan="3" style="font-family:Arial; font-size:25px;">SIGN UP</td>
					</tr>
					<tr>
						<td>Name*</td>
						<td><input type="textbox" required name="name" id="i1" style="color:black"></td>
						<td><span id="s1" style="color:red;"></span></td>
					</tr>
					<tr>
						<td>DOB*</td>
						<td><input type="date" required name="dob" id="i2" style="color:black"></td>
						
					</tr>
					<tr>
						<td>Gender*</td>
						<td><input type="radio" name="gender" value="male" checked>Male <input type="radio" name="gender" value="female">Female</td>
					</tr>
					<tr>
						<td>Email id*</td>
						<td><input type="email" required name="email" id="i3" style="color:black"></td>
						
					</tr>
					<tr>
						<td>Mobile Number*</td>
						<td><input type="textbox" required name="mobile" id="i7" style="color:black"></td>
						<td><span id="mob"></span></td>
					</tr>
					<tr>
						<td>Username*</td>
						<td><input type="textbox" required name="username" id="i4" style="color:black"></td>
						
					</tr>
					<tr>
						<td>Password*</td>
						<td><input type="password" required name="password" id="i5" style="color:black"></td>
						<td><span>(min 8 characters)</span></td>
					</tr>
					<tr>
						<td>Confirm Password*</td>
						<td><input type="password" required name="confirmpassword" id="i6" style="color:black"></td>
						<td><span id="cpwd"></span></td>
					</tr>
					<tr>
						<td><button class="btn btn-default"><b>START ACCESSING!</b></button></td>
					</tr>
				</table>
				</form>
			</td>
		</tr>
	</table>
	<div style="position:absolute;bottom:0px;right:0px;background-color:black;color:white;">&copy; ACCESS IT! ALL RIGHTS RESERVED &nbsp; </div>
</body>
</html>
