<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body {
    background-color:#1aa6c9;

}
        </style>
</head>
<body>
<?php
$conn=mysqli_connect("localhost","root","","oams");

if(isset($_FILES["webcam"]["tmp_name"])){
    $tmpName=$_FILES["webcam"]["tmp_name"];
    $imageName=date("Y.m.d") . " - " . date("h.i.sa") . ' .jpeg';
    move_uploaded_file($tmpName, 'img/' . $imageName);

    $date = date("Y/m/d") . " & " . date("h:i:sa");
    $query = "INSERT INTO tb_image VALUES('','$date','$imageName')";
    mysqli_query($conn,$query);
}
?>
</body>
</html>