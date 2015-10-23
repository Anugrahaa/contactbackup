<?php
session_start();
$id=$_SESSION['id'];
$usr=$_SESSION['Username'];
@mysql_connect("localhost","root","");
@mysql_select_db("accessit");
$query=mysql_query("select * from user where id='$id' order by Name");

while($row=mysql_fetch_assoc($query))
{
	$return[]=$row;
}
$_SESSION['id']=$id;
$_SESSION['Username']=$usr;
echo json_encode($return);

?>