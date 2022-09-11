<!DOCTYPE html>
<head>
    <style>
        body{
            background-color:#s1aa6c9;
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

$Username="localhost";
$Servername="root";
$Password="";
$DBName="OAMS";

//Setting up the Connection
$conn=new mysqli($Username,$Servername,$Password,$DBName);
if($conn->connect_error)
die("Connection Failed".$conn->connect_error);

$sql="select toallow from allowattendance";

$res = $conn->query($sql);
$row=$res->fetch_assoc();
if (strcmp("YES",$row["toallow"])==0)
{
    header("Location:http://localhost/Sample/VFRV/public/index.html" );
}
else{
    echo "<h1>Oops! Your teacher has turned off the responses!";
    echo "<a href='Student.html'><h6>Go Back to Student's Tab</h6></a>";
}

?>