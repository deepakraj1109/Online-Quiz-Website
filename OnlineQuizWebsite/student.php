<?php
$conn = mysqli_connect("localhost", "root", "", "kumar");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['submit'])) {
    $c = 0;
    $id = $_POST['id'];
    $a1 = $_POST['first'];
    $a2 = $_POST['second'];
    $a3 = $_POST['third'];
    $a4 = $_POST['fourth'];
    $a5 = $_POST['fifth'];
    $a6 = $_POST['sixth'];
    $a7 = $_POST['seventh'];
    $a8 = $_POST['eighth'];
    $a9 = $_POST['ninth'];
    $a10 = $_POST['tenth'];
    
    $q = "INSERT INTO ans (id, a, b, c, d, e, f, g, h, i, j) VALUES ('$id', '$a1', '$a2', '$a3', '$a4', '$a5', '$a6', '$a7', '$a8', '$a9', '$a10')";
    
    if(mysqli_query($conn, $q)) {
        $q1 = "SELECT * FROM ans WHERE id='$id'";
        $r = mysqli_query($conn, $q1);
        
        while($row = mysqli_fetch_array($r)) {
            if($row['a'] == '4') {
                $c++;
            }
            if($row['b'] == '3') {
                $c++;
            }
            if($row['c'] == '4') {
                $c++;
            }
            if($row['d'] == '2') {
                $c++;
            }
            if($row['e'] == '2') {
                $c++;
            }
            if($row['f'] == '1') {
                $c++;
            }
            if($row['g'] == '4') {
                $c++;
            }
            if($row['h'] == '4') {
                $c++;
            }
            if($row['i'] == '2') {
                $c++;
            }
            if($row['j'] == '4') {
                $c++;
            }
        }
    } else {
        echo "Error: " . $q . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
<html>
<head>
<style>
h4 {
    position: fixed;
    margin-left: 90%;
    font-size: 30px;
}

</style>
</head>
<body background="7.jpg" style="position: fixed; background-size: cover">
    <h4><a href="logout.php">Logout</a></h4>
    <br><br><br><h1 style="margin-left:34%;font-size:100px;font-family:French Script MT;position:fixed">Congratulations</h1><br><br><br><br><br><br><br>
    <?php 
    if($c > 7) {
        $a = 'A';
    } elseif($c >= 5 && $c <= 7) {
        $a = 'B';
    } elseif($c < 5 && $c >= 3) {
        $a = 'C';
    } else {
        $a = 'F';
    }
    echo "<p style='font-family:Agency FB;font-size:85px;'>The result is $c out of 10. Your percentage is " . ($c * 10) . "%<br>&emsp;&emsp;Your evaluated grade in the quiz is $a .<br>&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;Please do Logout.<br>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Thank you !!!!</p>" ?>
</body>
</html>
