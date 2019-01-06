<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>EmotiGre - Logout</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="res/main.css" />
    <script src="res/main.js"></script>
</head>
<body>

<?php
    // remove all session variables
    session_unset(); 

    // destroy the session 
    session_destroy(); 
?>
    <div id='spinner' class='itemsCentered' style="position: absolute; width: 100%; height: 100%; visibility: visible">
        <div class="loader"></div>
    </div>
    <div class='mainLoginContainer'>
        <div class='welcomeMessage'>You've been logged out!</div>
        We are redirecting you to the login page.
    </div>
    <script>
        setTimeout(() => {
            window.location.replace("./");
        }, 1000);
    </script>
</body>
</html>