<?php
session_start();
$id=$_SESSION['id'];
include_once "boot.php";
@mysql_connect("localhost","root","") or die(mysql_error());
@mysql_select_db("accessit");

$query = mysql_query("select * from main where id=$id");
$row=mysql_fetch_assoc($query);
?>
<style type="text/css">
	.clickable:hover{
		cursor:pointer;
		opacity:0.8;
	}
	.clickable:active{
		cursor: pointer;
		position: relative;
		top:2px;
	}
	table{
		position: absolute;
		top: 100px;
		left:200px;
		padding: 10px;
		font-size: 18px;
		font-family: cursive; 
	}
	table td{
		border: 1px solid black;
		padding: 10px;
	}
	#cpwd{
		position: fixed;
		top:100px;
		left:300px;
		font-family: cursive;
		font-size: 15px;
		background-color: "#420021";
		color: "white";
		display: none;
	}
</style>
<script type="text/javascript">
	function changepwd () {
		document.getElementById('cpwd').style.display="block";
	}
	function cancel(){
		document.getElementById('p1').value=document.getElementById('p2').value=document.getElementById('p3').value="";
		document.getElementById('cpwd').style.display="none";
		}
</script>
<table>
	<tr>
		<td>Name</td>
		<td><?php echo $row['Name'];?> </td>
	</tr>
	<tr>
		<td>DOB</td>
		<td><?php echo $row['DOB'];?> </td>
	</tr>
	<tr>
		<td>Gender</td>
		<td><?php echo $row['Gender'];?> </td>
	</tr>
	<tr>
		<td>Email ID</td>
		<td><?php echo $row['Email'];?> </td>
	</tr>
	<tr>
		<td>Mobile No</td>
		<td><?php echo $row['Mobile'];?> </td>
	</tr>
	<tr>
		<td>Username</td>
		<td><?php echo $row['Username'];?> </td>
	</tr>
	<tr>
		<td colspan=2 class="clickable" onclick="changepwd()"><!--<a href="changepwd.php">-->Change Password<!--</a>--></td>
	</tr>
</table>
<div id="cpwd">
	<table><form action="" method="post">
		<tr>
			<td>OLD PASSWORD</td>
			<td><input type="password" id="p1" name="oldpwd"></td>
		</tr>
		<tr>
			<td>NEW PASSWORD</td>
			<td><input type="password" id="p2" name="newpwd"></td>
		</tr>
		<tr>
			<td>CONFIRM PASSWORD</td>
			<td><input type="password" id="p3" name="cnewpwd"></td>
		</tr>
		<tr>
			<td><button class="btn btn-primary">SUBMIT</button></td>
			<td><button type="button" class="btn btn-default" onclick='cancel()'>CANCEL</button></td>
		</tr>
		</form>
	</table>
</div>