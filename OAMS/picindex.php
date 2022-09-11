<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Webcam</title>
</head>
<style media="screen">
    body {
    background-color:#1aa6c9;
    }


    .container{
        display:flex;
        flex-direction:column;
        align-items:center;
        margin-top:10px;
        font-size:38px;
    }
    #my_camera{
        border:ipx solid black;
        
    }

    .container button{
        width:480px;
        padding:12px;
        border:none;
        border-radius:20px;
        cursor:pointer;
        font-size:16px;
    }

    .container > button{
        background:#2eb82e;
        color:white;
    }

    .container a button{
        background: #2EB82E;
        color:white;
    }
</style>

<body onload="configure();">

<div class="container">
<h1>Image Registrations</h1>
    <div id="my_camera">
    
    </div>

    <div id="results" style = "visibility:hidden;position:absolute;">
    </div>
    <br>
    <button type="button" onclick="saveSnap();">Save</button>
    <a href="picimage.php"><button type="button" name="button">Go To Image Database Page &#x2192;</button></a>
    <a href="Student.html"><button type="button" name="button">Go To Student's Tab</button></a>
</div>


<script type="text/javascript" src="assets/webcam.min.js">

</script>
<script type="text/javascript">
    function configure(){
        Webcam.set({
            width:480,
            height:360,
            image_format:'jpeg',
            jpeg_quality:90
        });

    Webcam.attach('#my_camera');
    }

    function saveSnap(){
        Webcam.snap(function(data_uri){
        document.getElementById('results').innerHTML=
        '<img id="webcam" src="'+data_uri+'">';
        });
        
        Webcam.reset();

        var base64image=document.getElementById("webcam").src;
        Webcam.upload(base64image,'picfunction.php',function(code,text){
            alert("Saved Successfully");
            document.location.href="picimage.php"
        });
        
    }
</script>
</body>
</html>