<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: black;
        }

        * {
            box-sizing: border-box;
        }

        .container {
            padding: 16px;
            background-color: white;
        }

        input[type=text],
        input[type=password],
        input[type=email] {
            width: 50%;
            padding: 15px;
            font-size: 15px;
            margin: 5px 0 22px 0;
            display: inline-block;
            border: none;
            background: #f1f1f1;
        }

        input[type=text]:focus,
        input[type=password]:focus,
        input[type=email]:focus {
            background-color: #ddd;
            outline: none;
        }

        hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 5px;
        }

        .registerbtn {
            background-color: #3B5998;
            color: white;
            padding: 16px 16px;
            margin: 8px 0;
            border: none;
            font-size: 25px;
            cursor: pointer;
            width: 25%;
            opacity: 0.9;
        }

        .registerbtn:hover {
            background-color: white;
            color: #3B5998;
        }


        a {
            color: dodgerblue;
        }

        .signin {
            background-color: #f1f1f1;
            text-align: center;
        }
    </style>
</head>

<body>
    <form action="new1.php" method="post">
        <div class="container">
            <center>
                <h1>GO QUIZ-Login Form</h1>
                <hr>
                <b>Email:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="email" placeholder="Enter email" name="e" required>
                <br><br>
                <b>Password:</b>
                <input type="password" placeholder="Enter Password" name="p" required>
                <br><br>
                <h3>Select Role : <select name="type">
                        <option>student</option>
                    </select></h3><br><br>
                <center><button type="submit" class="registerbtn" id="d1" name="submit">Login</button><br><br>
                    <button type='reset' class="registerbtn " id="d1">Clear</button>
                </center><br>
                <h3>If you don't have an account, Please <a href="new.php">Register </a>here</h3><br>
        </div>
    </form>
</body>

</html>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "kumar";

$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $email = $_POST['e'];
    $pass = $_POST['p'];
    $type = $_POST['type'];

    $stmt = $conn->prepare("SELECT * FROM register WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($pass, $row['pass'])) {
            $stmt2 = $conn->prepare("SELECT * FROM login WHERE email=? AND role=?");
            $stmt2->bind_param("ss", $email, $type);
            $stmt2->execute();
            $result2 = $stmt2->get_result();

            if ($result2->num_rows == 1) {

                if ($type == 'student') {
                    header("Location: index1.html");
                    exit();
                } else {
                    echo "<script>alert('Invalid role');</script>";
                }
            } else {
                echo "<script>alert('Invalid role or credentials');</script>";
            }

            $stmt2->close();
        } else {
            echo "<script>alert('Invalid credentials');</script>";
        }
    } else {
        echo "<script>alert('Invalid credentials');</script>";
    }

    $stmt->close();
}

$conn->close();
?>