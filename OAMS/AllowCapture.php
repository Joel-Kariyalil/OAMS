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
$username=$_POST["usr"];
$allow=$_POST["allow"];

$Username="localhost";
$Servername="root";
$Password="";
$DBName="OAMS";

//Setting up the Connection
$conn=new mysqli($Username,$Servername,$Password,$DBName);
if($conn->connect_error)
die("Connection Failed".$conn->connect_error);

//inserting into the query by initially deleting the existing value

$sql="truncate table allowattendance";
$res = $conn->query($sql);
if($conn->query($sql))
{
    echo "Values are cleared!";
}

$sql="insert into allowattendance(username,toallow) values('$username','$allow')";
if($conn->query($sql))
{
    echo "<h1>Changes have been made!</h1>";
}
else
{
    echo "<h1>Oops! Seems like there's been an error!<br>".$conn->error;
}
echo "<a href='Teacher.html'><h3>Go Back to Login Page</h3></a>";
?>
</body>