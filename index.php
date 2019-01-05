<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="res/main.css" />
    <script src="res/main.js"></script>
</head>
<body onload='setUp()'>
    <div class='mainLoginContainer'>
        <div class='welcomeMessage'>Welcome to the EmotiGre login.</div>
        <a href='TwitterAuth.php' class='button firtTimeUserContainer'>
            <div class='buttonLabel'>I'm a first time user!</div>
            <div class='buttonIcon'>
                <img class='twitterSocialIcon' src='res/Twitter_Social_Icon_Rounded_Square_Color.png'/>
            </div>
        </a>
        <a href='#' class='button returningUserContainer' id='returningUserButton'>
            <div class='buttonLabel'>I'm a returning user!</div>
            <div class='buttonIcon'>🔑</div>
        </a>
        <form class='loginForm' id='loginForm'>
            <input type='text' placeholder='User Name'/>
            <input type='password' placeholder='Password'/>
            <button type='submit'>Login</button>
        </form>
    </div>
</body>
</html>