<?php
$name=$_POST["name"];
$dob=$_POST["dob"];
$gender=$_POST["gender"];
$email=$_POST["email"];
$username=$_POST["username"];
$password=sha1($_POST["password"]);
$mobile=$_POST["mobile"];


$conn=new mysqli("localhost","root","","accessit");
if($conn->connect_error){ die("connection failed ".$conn->connect_error());}

$query = mysqli_query("select * from main");

$id=gen_id($query);

function gen_id($query){
$g=rand(10000,99999);
while($row=mysqli_fetch_assoc($query))
{
	if($g==$row['id'])
		gen_id($query);
}
return $g;
}

$query = mysqli_query("select * from main");
$b=0;
while($row=mysqli_fetch_assoc($query))
{
	if($mobile==$row['Mobile'])
		{
			header("location:forms.php?err=user exists"); 
			$b++;
		}
}


if($b==0){
$query = mysqli_query("select * from main");

while($row=mysqli_fetch_assoc($query))
{
	if($username==$row['Username'])
	{
		header("location:forms.php?err=username exists, choose another username");
		$b++;
	}
}
if($b==0){
	$stmt=$conn->prepare("insert into main (id,Name,DOB,Gender,Mobile,Email,Username,Password) values (?,?,?,?,?,?,?,?)");
	$stmt->bind_param("isssisss",$id,$name,$dob,$gender,$mobile,$email,$username,$password);
	$stmt->execute();
header("location:forms.php?msg=created new user");
}
}
?>