<?php
session_start();
if(!empty($_POST)){
$username=$_POST["username"];
$password=sha1($_POST["password"]);

@mysql_connect("localhost","root","") or die(mysql_error());
@mysql_select_db("accessit");

$query = mysql_query("select * from main");
$b=0;
while($row=mysql_fetch_assoc($query))
{
	if($username==$row['Username'])
	{
		if($password==$row['Password'])
			{	$id=$row['id'];
				$_SESSION['id']=$id;
				$_SESSION['Username']=$username;
				header("location:onlogin.php");
				$b++;
			}
		else 
		{
			header("location:forms.php?err=invalid username or password");
		}
	}
}
if($b==0)
header("location:forms.php?err=invalid username or password");
}
else {
if(isset($_SESSION['Username'])&&$_SESSION['Username']!="")
	header("location:onlogin.php");
else
	header("location:forms.php");}
?>
