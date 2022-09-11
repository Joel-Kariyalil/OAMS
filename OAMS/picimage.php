<?php
require 'picfunction.php'
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Image Database</title>


<style>
     body {
    background-color:#1aa6c9;
    text-align:center;
    margin-padding:50px;
}

table {
    text-align:center;
    margin-left:auto; margin-right:auto;
    font-size:20px;
    font-weight:bold;
}
    a button{
        padding:20px;
        border:none;
        border-radius:20px;
        cursor:pointer;
        font-size:20px;
        background: #2EB82E;
        color:white;
    }
   
</style>
</head>

<body>
    <table border=1 cellspacing=0 cellpadding =10>
        <tr>
            <td>#</td>
            <td>Date & Time</td>
            <td>Image</td>  
        </tr>
        <?php
        $i=1;
        $rows=mysqli_query($conn,"SELECT* from tb_image ORDER BY id DESC");
        ?>
        <?php foreach($rows as $row) : ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row["date"]; ?></td>
                <td><img src="img/<?php echo $row["image"]; ?>" width=200 title="<?php echo $row["image"]; ?>"></td>

            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="picindex.php"><button type="button" name="button">Webcam</button></a>
</body>
</html>