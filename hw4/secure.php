<?php
    session_start();
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
            <?php
                if($_SESSION['authenticated'] !== true){
                    echo '<p>You are not authorized to view this page. Please Try to Login Again by Clicking <a href="index.php">here.</a></p>';
                } else {
                    printBody();
                }

                function printBody(){
                    echo '<div class="row justify-content-center">';
                    echo '<div class="col">';
                    echo '<div class="row justify-content-center">';
                    echo '<h5>Welcome ' . $_SESSION['user'] . "! You have " . clearanceLetterToWord($_SESSION['clearance']) . " Clearance.</h5>";
                    echo '</div>';
                    echo '<div class="row justify-content-center">';
                    printSecureData($_SESSION['clearance']);
                    echo '</div>';
                    echo '<div class="row justify-content-center">';
                    echo '<a href="logout.php" class="btn btn-danger my-3">Logout</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }

                function clearanceLetterToWord($clearance){
                    switch ($clearance){
                        case 'S':
                            return 'SECRET';
                            break;
                        case 'T':
                            return 'TOP SECRET';
                            break;
                        case 'U':
                            return 'UNCLASSIFED';
                            break;
                        case 'C':
                            return 'CONFIDENTIAL';
                            break;
                    }
                }

                function printSecureData($clearance){
                    switch ($clearance){
                        case 'T':
                            echo "<img src='public/TopSecret.png' width='300px' height='300px' class='img-responsive mx-auto mt-3'>";
                            echo "<img src='public/Secret.png' width='300px' height='300px' class='img-responsive mx-auto mt-3'>";
                            echo "<img src='public/Confidential.png' width='300px' height='300px' class='img-responsive mx-auto mt-3'>";
                            echo "<img src='public/Unclassified.png' width='300px' height='300px' class='img-responsive mx-auto mt-3'>";
                            break;
                        case 'S':
                            echo "<img src='public/Secret.png' width='300px' height='300px' class='img-responsive mx-auto mt-3'>";
                            echo "<img src='public/Confidential.png' width='300px' height='300px' class='img-responsive mx-auto mt-3'>";
                            echo "<img src='public/Unclassified.png' width='300px' height='300px' class='img-responsive mx-auto mt-3'>";
                            break;
                        case 'C':
                            echo "<img src='public/Confidential.png' width='300px' height='300px' class='img-responsive mx-auto mt-3'>";
                            echo "<img src='public/Unclassified.png' width='300px' height='300px' class='img-responsive mx-auto mt-3'>";
                            break;
                        case 'U':
                            echo "<img src='public/Unclassified.png' width='300px' height='300px' class='img-responsive mx-auto mt-3'>";
                            break;
                    }
                }
            ?>
        </div>
    </body>
</html>
