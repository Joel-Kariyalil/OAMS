<!DOCTYPE html>
<head>
    <style>
        body{
            background-color:#2c2602a2;
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
$password=$_POST["pwd"];

$Username="localhost";
$Servername="root";
$Password="";
$DBName="OAMS";

//Setting up the Connection
$conn=new mysqli($Username,$Servername,$Password,$DBName);
if($conn->connect_error)
die("Connection Failed".$conn->connect_error);

//Checking the if there are users with the mentioned username and password

$sql="select* from users where username='$username'";
$res = $conn->query($sql);
if (empty($res)) 
{
echo "<h1>Oops! Not a Validated User</h1>";
echo "<a href='create.html'><h3>Go Back to Login Page</h3></a>";
}
else{
    $row=$res->fetch_assoc();
    if (strcmp($password,$row["password"])==0)
    {
       if((strcmp("Student",$row["role"])==0)||(strcmp("student",$row["role"])==0))
       {
            header("Location:http://localhost/Sample/OAMS/Student.html" );
       }
       else if((strcmp("Teacher",$row["role"])==0)||(strcmp("teacher",$row["role"])==0))
       {
        header("Location:http://localhost/Sample/OAMS/Teacher.html" );
    }
    }
    else
    {
        echo "<h1>Oops! Incorrect Password</h1>";
        echo "<a href='Index.html'><h3>Go Back to Login Page</h3></a>";
    }

}
?>
</body>