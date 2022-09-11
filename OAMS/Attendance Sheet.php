<!DOCTYPE html>
<html lang="en">
<head>
    <title>Attendance Sheet</title>
    <style>
        table{
            text-align:left;
            border: 1px dotted black;
            border-spacing:40px;
            align="center";
            margin-left: auto;
            margin-right: auto;
            margin-top:100px;
            background-color:lightgreen;
        }
        body{
            background-color:#1aa6c9;
        }
        th{
            font-size:30px;
        }
        td{
            font-size:25px;
        }
        h1{
            text-align:center;
            margin-top:100px;
            font-size:50px;
        }
    </style>
</head>
<body>

<h1>Attendance Sheet</h1>
    <?php

$Username="localhost";
$Servername="root";
$Password="";
$DBName="OAMS";

//Setting up the Connection
$conn=new mysqli($Username,$Servername,$Password,$DBName);
if($conn->connect_error)
die("Connection Failed".$conn->connect_error);

$sql="select u.username, u.name, u.role, s.present, s.recorded_date, s.recorded_time from users u, studentattendance s where u.username=s.username";
$result=$conn->query($sql);

echo "<table>";
echo "<tr>";
echo "<th>Username</th><th>Name</th><th>Role</th><th>Present</th><th>Date</th><th>Time</th>";
echo "</tr>";
        
        

if($result->num_rows>0)
{
    while($row=$result->fetch_assoc())
    {
        //echo ."\t".$row["name"]. "\t".$row["role"]. "\t".$row["present"]. "\t".$row["recorded_date"]. "\t".$row["recorded_time"]."<br>";
        echo "<tr>";
        echo "<td>".$row["username"]."</td><td>".$row["name"]."</td><td>".$row["role"]."</td><td>".$row["present"]."</td><td>".$row["recorded_date"]."</td><td>".$row["recorded_time"]."</td>";
        echo "</tr>";

    }
}
else{
    echo "0 Results";
}


?>
</body>
</html>