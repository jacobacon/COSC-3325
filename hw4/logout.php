<?php
session_start();
?>

<?php
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $_SESSION['authenticated'] = false;
    session_destroy();
}
?>
<!DOCTYPE html>
<html>
<head>
    <script>
        window.location.replace('index.php');
    </script>
</head>
<body>
    <a class="btn btn-primary" href="index.php">Click Here if You Are Not Auto Redirected</a>
</body>
</html>
