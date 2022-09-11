<!DOCTYPE html>
<head>
    <style>
        body{
            background-color:#1aa6c9;
            color: #FFF;
        }
        h1,h3{
            text-align:center;
            margin:200px;
        }
        a{
        text-align:center;
        }
        </style>
</head>
<body>
<?php

$usr=$_POST["usr"];
$pswd=$_POST["pwd"];
$rpswd=$_POST["rpwd"];

if (strcmp($pswd,$rpswd)!=0)
{
    echo "<h1>Oops! The Re-Entered Password seem different!";
}
else{
$Username="localhost";
$Servername="root";
$Password="";
$DBName="OAMS";

//Setting up the Connection
$conn=new mysqli($Username,$Servername,$Password,$DBName);
if($conn->connect_error)
die("Connection Failed".$conn->connect_error);

$sql="update users set password='$pswd' where username='$usr'";

if($conn->query($sql))
{
    echo "<h1>Password is Updated!</h1>";
}
}

echo "<a href='Index.html'><h3>Go Back to Login Page</h3></a>";
?>