<?php 
include_once "boot.php";
//require_once "addcontact.php";
session_start();
$usr=$_SESSION['Username'];
$id=$_SESSION['id'];
?>
<html>
<head>
	<title>ACCESS IT!</title>
	<style type="text/css">
	.nav{
		background-color:#420021;
		position: fixed;
		top: 0px;
		left: 0px;
		width: 100%;
		height: 34px;
		
	}
	#add{
		 position:fixed; 
		 top:0px; 
		 left:15px; 
		 padding:5px; 
		 background-color:#420021; 
		 font-size:15px;
		 
		 }
	#welcome{
		position:fixed; 
		 top:0px; 
		 right:15px; 
		 padding:5px; 
		 background-color:#420021; 
		 font-size:15px;
		 color: white;
		
	}
	#addcontact{
		position: fixed;
		top:35px;
		background-color: #420021;
		font-size: 15px;
		color:white;
		display: none;
		padding: 5px;
	}
	#account{
		position: fixed;
		top: 35px;
		right: 15px;
		background-color: #420021;
		font-size: 15px;
		color: white;
		display: none;
	}
	#account td{
		padding: 10px;
	}
	.clickable:hover{
		cursor:pointer;
		opacity:0.8;
	}
	.clickable:active{
		cursor: pointer;
		position: relative;
		top:2px;
	}
	#table td{
		padding:5px;
	}
	#view{
		position: absolute;
		top: 100px;
		left:200px;
		padding: 10px;
		font-size: 18px;
		font-family: cursive; 
	}
	#view td{
		border: 1px solid black;
		padding: 10px;
	}
	#search{
		position: absolute;
		top:50px;
		right: 50px;
		color:black;
	}
	#search td{
		padding: 10px;
	}
	</style>
	<script src = "jquery-1.11.3.min.js"></script>
	<script type="text/javascript">
	var b=0;
		function addclicked () {
			document.getElementById('addcontact').style.display="block";
		}
		function cancel(){
			document.getElementById('name').value=document.getElementById('phno').value="";
			document.getElementById('address').value=document.getElementById('email').value="";
			document.getElementById('addcontact').style.display="none";
		}
		function welcomeclicked(){
			if(b%2!=0)
				document.getElementById('account').style.display="none";
			else
				document.getElementById('account').style.display="block";
			b++;
		}
		function save(){
			var ph=document.getElementById('phno').value;
			for(var z in ph)
			{
				if(!(ph[z]>='0'&&ph[z]<='9'||ph[z]=='+'))
				{
					alert("Contact no. is a numeric field");
					return false;
				}
			}
			document.getElementById('addcontact').style.display="none";
			var postData=$("#addcontactform").serializeArray();
			var request=$.ajax({
				url: "addcontact.php",
				type: "POST",
				data: postData
			});
			printsave();
		}
			function printsave(){
			$.get("printcontacts.php",function(data){
				console.log($.parseJSON(data));
				data=$.parseJSON(data);
				$("#view").html("");
				$("#view").html('<tr style="font-size:22px;"><b><td>NAME</td><td>CONTACT NUMBER</td><td>ADDRESS</td><td>EMAIL ID</td></b></tr>');
				for(var i in data)
				{
				$("#view").append("<tr><td>" + data[i].Name + "</td><td><a href='tel:" + data[i].PhoneNo + "'>"+data[i].PhoneNo +"</a></td><td>" + data[i].Address +"</td><td>"+ data[i].Email+"</td><td class='clickable' onclick='delete()'>DELETE</td></tr>").fadeIn("slow");
				}
			});
			return false;
		}
		function signout()
		{	
			$.get("signout.php");
			document.location="forms.php";
		}
		function account()
		{
			document.location="account.php";
		}
		/*function delete()
		{
			$.get("delete.php"+"?Name="+arguments[0]+"&Ph="+arguments[1]+"?Address="+arguments[2]+"?Email="+arguments[3]);
			printsave();
		}*/
	</script>


</head>
<body style="font-family:Papyrus;">
	<div class="nav"></div>
	<div id="add"><span class="clickable" style="color:white;" onclick="addclicked()">ADD</span></div>
	<div id="welcome"><span class="clickable" onclick="welcomeclicked()">Welcome&nbsp;
	 <?php

	@mysql_connect("localhost","root","") or die(mysql_error());
	@mysql_select_db("accessit");
	
	echo $usr;
?>
</span>
</div>
<div id="search">
	<form action="" method="post">
		<table>
			<tr>
				<td>SEARCH:</td>
				<td><input type="textbox" placeholder="Name" name="search"></td>
				<td><button class="btn btn-primary btn-xs" style="background-color:#420021;">GO</button></td>
			</tr>
		</table>
	</form>
</div>
<table id="view">
	<tr style="font-size:22px;">
		<b>
		<td>NAME</td>
		<td>CONTACT NUMBER</td>
		<td>ADDRESS</td>
		<td>EMAIL ID</td>
		<td>DELETE</td>
	</b>
	</tr>
<?php

printcontacts($id);
function printcontacts($id){

$query=mysql_query("select * from user where id='$id' order by Name");
if(!empty($_POST['search']))
{
$name=$_POST['search'];
$name=mysql_real_escape_string($name);
$query=mysql_query("select * from user where id='$id' AND Name like '%$name%' order by Name");}
while($row=mysql_fetch_assoc($query))
{
	echo "<tr><td>".$row['Name']."</td><td>";?><a href="tel:<?php echo $row['PhoneNo'];?>"><?php echo $row['PhoneNo']."</a></td><td>".$row['Address']."</td><td>".$row['Email']."</td><td class='clickable' onclick='delete(".$row['Name'].",".$row['PhoneNo'].",".$row['Address'].",".$row['Email'].")'>DELETE</td></tr>";
}
}
?>

</table>
<div id="addcontact">
	<form action="" id="addcontactform" method="post">
	<table id="table" style="color:white; padding:5px;">
		<tr>
			<td>Name:</td><td><input type="textbox" id="name" name="name" style="color:black;"></td>
			<td>Contact no.:</td><td><input type="textbox" id="phno" name="phone" style="color:black;"></td>
		
		</tr>
		<tr>
			<td>Address:</td><td><input type="textarea" id="address" name="address" style="color:black;"></td>
			<td>Email Id:</td><td><input type="email" id="email" name="email" style="color:black;"></td>
		</tr>
		<tr>
			<td><input type="hidden" name="username" value="<?php echo $_SESSION['Username']; ?>"></td>
			<td><input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>"></td>
		</tr>
		<tr>
			<td><button type="button" class="btn btn-default btn-xs" onclick="save()">SAVE</button></td>
			<td></td><td></td>
			<td><button type="button" onclick="return cancel();" class="btn btn-default btn-xs">CANCEL</button></td>
		</tr>
	</table>
	</form>
</div>
<div id="account">
	<table>
		<tr><td class="clickable" onclick="account()">Account details</td></tr>
		<tr><td class="clickable" onclick="signout()">Sign Out</td></tr>
	</table>
</div>
</body>
</html>