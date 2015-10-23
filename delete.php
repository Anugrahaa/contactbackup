<?php
session_start();
$n=$_GET['Name'];
$p=$_GET['Ph'];
$a=$_GET['Address'];
$e=$_GET['Email'];
$id=$_SESSION['id'];

@mysql_connect("localhost","root","") or die(mysql_error());
@mysql_select_db("accessit");

$n=mysql_real_escape_string($n);
$p=mysql_real_escape_string($p);
$a=mysql_real_escape_string($a);
$e=mysql_real_escape_string($e);


$query = mysql_query("delete from user where id=$id and Name='$n' and PhoneNo='$p' and Address='$a' and Email='$e'");
?>