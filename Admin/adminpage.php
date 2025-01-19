<?php
session_start();
include '../conn.php';
?>

<html>

<head>
    <link rel="stylesheet" href="../format.css">
</head>

<body class="background">
    <div class="heading" style="background-color: rgb(0, 85, 255)">
        <h1>Thometheus Typing</h1>
    </div>
    <div class="subheading" style="background-color: rgb(76, 135, 255)">
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

    </div>
</body>

</html>