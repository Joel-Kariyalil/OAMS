<!DOCTYPE html>
<head>
    <style>
        body{
            background-color:#1aa6c9;;
            color: #FFF;
        }
        h1{
            text-align:center;
            margin:100px;
        }
        a{
        text-align:center;
        margin:100px;
        }
        </style>
</head>
<body>

<?php
$username=$_POST["usr"];
$name=$_POST["name"];
$password=$_POST["pwd"];
$email=$_POST["email"];
$phno=$_POST["phno"];
$role=$_POST["role"];

$User="localhost";
$Servername="root";
$Psswrd="";
$DBName="OAMS";

//Setting up the Connection
$conn=new mysqli($User,$Servername,$Psswrd,$DBName);

if($conn->connect_error)
die("Connection Failed".$conn->connect_error);

//Not doing PHP Validations as the Data Recieived is already validated!

$sql="insert into users(username,name,password,email,phno,role) values ('$username','$name','$password','$email',$phno,'$role')";

if($conn->query($sql)==TRUE)
{
    echo "<h1>Values Initialized!</h1>";
}
else
{
        echo "<br>Error".$conn->error;
}
?>

<a href="Index.html">Go Back to Login Page</a>

</body>