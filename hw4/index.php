<?php
session_start();
?>
<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/security/hw4/securimage/securimage.php';

$securimage = new Securimage();

if(isset($_POST) && (($_SERVER['REQUEST_METHOD'] === 'POST'))){
    function verifyLogin($username, $password)
    {
        //SQL Connection
        $servername = "localhost";
        $db_username = "jbeneski_login";
        $db_password = "password123";
        $dbname = "jbeneski_security";

        $conn = new mysqli($servername, $db_username, $db_password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM `UserAccounts` WHERE username='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            //Verify username and password
            while ($row = $result->fetch_assoc()) {
                //echo $row['username'] . " " . $row['password'] . "Input username: " . $username . " md5 of input: " . md5($password);
                if ($row['username'] === $username && $row['password'] === md5($password)) {
                    $conn->close();
                    $_SESSION['clearance'] = $row['clearance'];
                    $_SESSION['user'] = $row['username'];
                    return true;
                }
            }
            $conn->close();
            return false;
        } else {
            $conn->close();
            return false;
        }
    }

    if ($securimage->check($_POST['captcha_code']) == false) {
        // the code was incorrect
        // you should handle the error so that the form processor doesn't continue

        // or you can use the following code if there is no validation or you do not know how
        echo "The security code entered was incorrect.<br /><br />";
        echo "Please go <a href='javascript:history.go(-1)'>back</a> and try again.";
        exit;
    } else {
        if(verifyLogin($_POST['username'], $_POST['password'])){
            $_SESSION['authenticated'] = true;
            header('Location: secure.php');
        } else {
            echo 'Incorrect Login Information';
        }
    }

}
?>


<!DOCTYPE html>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Secure Data Vault Access Page</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <link rel="stylesheet" href="public/app.css">
        <script src="public/app.js"></script>
    </head>
    <body>

    <div class="container pt-3">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Login</h5>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <img id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image" />
                        <input type="text" name="captcha_code" size="10" maxlength="6" required/>
                        <a href="#" onclick="document.getElementById('captcha').src = 'securimage/securimage_show.php?' + Math.random(); return false">[ Different Image ]</a>
                    </div>
                    <button type="submit" class="btn btn-success">Login</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>





