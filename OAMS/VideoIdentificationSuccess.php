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

$Username="localhost";
$Servername="root";
$Password="";
$DBName="OAMS";

date_default_timezone_set("Asia/Kolkata");
$times=date("h:i:sa");
$day= date("Y-m-d");

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
    if((strcmp("Student",$row["role"])==0)||(strcmp("student",$row["role"])==0))
    {
    $insertsql="insert into StudentAttendance (username, present,recorded_time, recorded_date) values('$username','YES','$times','$day')";
    
    if($conn->query($insertsql))
    {
        echo "<h1>Attendance Successfully Recorded!</h1>";
        echo "<a href='Student.html'><h3>Go Back to Student's Tab</h3></a>";
    }
    else{
        echo "Error Occured; ".$conn->error;
    }
}
else{
    echo "<h1>Entered Username Doesn't Belong to a Student!</h1>";
    echo "<a href='Student.html'><h3>Go Back to Student's Tab</h3></a>";
}


}
?>
</body>