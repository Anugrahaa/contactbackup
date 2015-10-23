<?php
//session_set_cookie_params(0);
session_start();

$name=$_POST['name'];
$phone=$_POST['phone'];
$address=$_POST['address'];
$email=$_POST['email'];
$id=$_POST['id'];
$usr=$_POST['Username'];

$conn=new mysqli("localhost","root","","accessit");
if($conn->connect_error) {die("connection failed ".$conn->connect_error());}
$stmt=$conn->prepare("insert into user (id,Name,PhoneNo,Address,Email) values (?,?,?,?,?)");
$stmt->bind_param("isiss",$id,$name,$phone,$address,$email);
$stmt->execute();
$_SESSION['id']=$id;
$_SESSION['Username']=$usr;
header("location:onlogin.php");
?>