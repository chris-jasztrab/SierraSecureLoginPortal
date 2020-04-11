<?php
include('../private/initialize.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$resource = $_GET['resource'] ?? '';
$_SESSION['resource'] = $resource;
$redirect = $_GET['redirect'] ?? '';
$_SESSION['redirect'] = $redirect;
$_SESSION['failedlogin'] = '0';
$barcode = $_POST['barcode'] ?? '';
$pin = $_POST['pin'] ?? '';

if (is_post_request()) {
    $result = validatePatron($barcode, $pin);
    if ($result == NULL) {
        $patronID = findPatronIDByBarcode($barcode);
        $_SESSION['patronID'] = $patronID;
        $resource = $_GET['resource'] ?? '';
        $_SESSION['resource'] = $resource;
        $_SESSION['failedlogin'] = '0';
        if($resource = 'Ancestry') {
            redirect_to('https://ancestrylibrary.proquest.com/aleweb/ale/do/login/refurl');
        }
        echo 'successful login but no resource';
        pre($_SESSION);

        die();
        //echo 'logged in';
    }
    $login_failure_msg = "Log in was unsuccessful.";
    $_SESSION['failedlogin'] = '1';

    // if there were no errors, try to login
    // Using one variable ensures that msg is the same

}

?>

<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
<script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<style>

    .form-control {
        font-size: large;
    }

    .submit {
        background-color: #006368;

    }

    body {
        background-image: url('/images/ecardbackground.png');
    }


</style>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>MPL Secure Login Form</title>

    <!-- Bootstrap core CSS -->
    <link href="../../css/editor.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="narrow-jumbotron.css" rel="stylesheet">
    <link href="../onlinecardregistration/assets/multistepform/css/style.css" rel="stylesheet">
</head>

<body>

<center><img src="images/beetrail.png" width="30%"  alt="ecard Title"/> </center>
<div class="container">
    <div class="header clearfix">
        <nav>
            <ul class="nav nav-pills float-right">
                <li class="nav-item">

                </li>
                <li class="nav-item">

                </li>
                <li class="nav-item">

                </li>
            </ul>
        </nav>

    </div>

    <div class="col-lg-12 ">

        <div class="row">
            <div class="col-xs-1"></div>
            <div class="col-xs-10 transbox" style="color: black">
                <h1 style="font-weight: bold">Secure Login Form</h1>
                <p class="lead">  <h2>You were redirected to this page because you are trying to access a <?php echo $resource; ?> which requires you to enter in your Library Card # and PIN

                 </h2></p>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-1"></div>
            <div class="col-xs-10 transbox" style="color: black">
                <form style="" action="sierrasecureportal.php" method="post" autocomplete="off">
                    <div class="form-group">
                        <?php if($_SESSION['failedlogin'] == '1')
                        {
                            echo ' <div class="row" style="">
                                <div class="col-lg-12">
                                    <font color="red"> <h3>Invalid Login - Please check your library card number and pin and try again.</label></h3></font>
                                </div>
                            </div>';
                            lb();
                        } ?>
                        <div class="row" style="">
                            <h3>Please login with your library card # and PIN.</h3>
                        </div>
                        <br>
                        <div class="row" style="">
                            <div class="col-lg-6">
                                <h4><label>Library Card Number</label>
                                    <input type="text" class="form-control" name="barcode">
                                </h4>
                            </div>
                            <div class="col-lg-6">
                                <h4><label>PIN</label>
                                    <input type="password" class="form-control" name="pin">
                                </h4>
                            </div>
                        </div>
                        <br>
                        <input type="submit" name="submit" class="submit action-button btn btn-lg btn-success"  value="Login"/>
                    </div>
                </form>
                <footer class="footer">
                    <p>&copy; Milton Public Library <?php echo date("Y"); ?>  </p>
                </footer>
            </div>
        </div>
    </div>
</div>



</body>
</html>


