<?php
  session_start();
  if(!isset($_SESSION["USER"])) {
    die ('You are not allowed to view this content');
  }
  $screenName = $_SESSION["USER"]
?>
<!DOCTYPE html>
<!-- saved from url=(0072)http://stuiis.cms.gre.ac.uk/ha07/Responsive/Breakpoint/w3c-3b.html#about -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="./res/home.css">
<script>
  <?php
    $user = $_SESSION["USER"];
    echo 'const user = '.json_encode($user).';';
  ?>
</script>
<script src="res/home.js"></script>
</head>
<body onload="loadTweets(user.screenName, populateMainPage)">

<div class="header">
  <h1>EmotiGre - Greenwich Emotions Analyzer</h1>
</div>

<ul class="topnav">
  <!-- <li><a class="active" href="#home">Home</a></li> -->
  <li><a href="#" onclick="populateMainPage(TWEETPAGE)">Home</a></li>
  <li><a href="#" onclick="populateMainPage(USERPAGE)">Users</a></li>
  <li><a href="#" onclick="populateMainPage(PROFILEPAGE)">Profile</a></li>
  <li><a href="#" onclick="populateMainPage(ADMINPAGE)">Admin</a></li>
  <li><a href="logout.php"><img class="menuIcon" src='./res/logout.png' /></a></li>
</ul>

<div class="row">

<div class="col-3 col-m-3 menu">
  <ul>
    <li>All Tweets</li>
    <li>Positive</li>
    <li>Negative</li>
    <li>Neutral</li>
  </ul>
</div>

<div class="col-6 col-m-9 padded vertical" id="mainPage">
  
</div>

<div class="col-3 col-m-12">
  <div class="aside">
    <div id="avatarContainer" class="horizontal centeredV padded">
      <img class="iconRounded" src='./res/male-user.png' />
      <div class="descIcon" id="name">Stefano Cremona</div>
    </div>
    <div id="townContainer" class="horizontal centeredV padded">
      <img class="icon" src='./res/town.png' />
      <div class="descIcon" id="town">Roma - Italy</div>
    </div>
    <div id="jobContainer" class="horizontal centeredV padded">
      <img class="icon" src='./res/job.png' />
      <div class="descIcon" id="job">Software Developer</div>
    </div>
    <div id=aboutMeContainer" class="horizontal centeredV padded">
      <img class="icon" src='./res/aboutMe.png' />
      <div class="descIcon" id="about">I like travelling, fishing, playing tennis, IT, clubbing, going out with friends.</div>
    </div>
    <div id="ageContainer" class="horizontal centeredV padded">
      <img class="icon" src='./res/age.png' />
      <div class="descIcon" id="age">18-25</div>
    </div>
    <div id="kidsContainer" class="horizontal centeredV padded">
      <img class="icon" src='./res/kids.png' />
      <div class="descIcon" id="kids">0</div>
    </div>
  </div>
</div>

</div>

<div class="footer">
  <p>Resize the browser window to see how the content respond to the resizing.</p>
</div>




</body></html>