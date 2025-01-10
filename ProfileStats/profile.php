<?php
session_start();
include '../conn.php';
$ID = $_SESSION['UserID'];
$info = ($conn->query("SELECT * FROM AccountDB WHERE ID = '$ID'"))->fetch_assoc();
$username = $info['username'];
$welcomeheader = "<p class='helloText'>Hello ".$username."! Lets check your progress</p>";

?>
<html>

<head>
    <link rel="stylesheet" href="../format.css">
</head>

<body class="background">
    <div class="heading">
        <h1>Thometheus Typing</h1>
    </div>
    <div class="subheading">
        <a class="leftsittingbutton" href="https://www.ghscomputerscience.co.uk/Tom/ProfileStats/profile.php">
            <button id="Profile">Profile</button>
        </a>
        <a class="leftsittingbutton" href="https://www.ghscomputerscience.co.uk/Tom/ProfileStats/stats.php">
            <button id="Stats">Stats</button>
        </a>
        <a class="rightsittingbutton"  href="https://www.ghscomputerscience.co.uk/Tom/LoginRegister/login.php">
            <button id="LogOut">Log Out</button>
        </a>
        <a class="rightsittingbutton" href="https://www.ghscomputerscience.co.uk/Tom/Mainpage/typingtest.php">
            <button id="Home">Home</button>
        </a>
    </div>
    <div>
        <?php
        echo $welcomeheader;
        ?>
    </div>
    <div>
        <div class="side" style="left: 4%;">
            <p>otherside</p>
        </div>
        <div class="boxGrouping">
            <div class="infoBox">
                <p>box1</p>
            </div>
            <div class="infoBox">
                <p>box2</p>
            </div>
            <div class="infoBox">
                <p>box3</p>
            </div>
        </div>
    </div>

</body>

</html>