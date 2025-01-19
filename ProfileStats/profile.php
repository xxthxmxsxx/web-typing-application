<?php
session_start();
ob_start();
include '../conn.php';
$ID = $_SESSION['UserID'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['publicScores'] == "on") {
        $boxStatus = 1;
    } else {
        $boxStatus = 0;
    }
    $conn->query("UPDATE AccountDB SET onlineVisibility='$boxStatus' WHERE ID ='$ID'");
    echo "<script>alert('Preferences successfully updated');</script>";
}

$info = ($conn->query("SELECT * FROM AccountDB WHERE ID = '$ID'"))->fetch_assoc();

$welcomeheader = "<p class='helloText'>Hello " . $info['username'] . "! Lets check your progress</p>";
$avgScore = "<p>Average: " . $info['averageScore'] . "WPM</p>";
$topScore = "<p>Highscore: " . $info['topScore'] . "WPM</p>";
$totals = "<p>Words Spelt: " . $info['totalWords'] . " Words</p><p>Time Typing: " . $info['totalTime'] . " Seconds</p>";
$accountName = "<h3><u>Username:</u></h3><p>" . $info['username'] . "</p><br>";

if ($info['onlineVisibility'] == 1) {
    $isChecked = " checked";
} else {
    $isChecked = "";
}
$onlineVisibility = "<h3><u>Public scores</u></h3><p>Tick box to appear online</p><form method='post'><input type='checkbox' name='publicScores'" . $isChecked . "><input type='Submit' value='Update Setting'></form";
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
        <a class="rightsittingbutton" href="https://www.ghscomputerscience.co.uk/Tom/LoginRegister/login.php">
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
            <?php
            echo $accountName;
            ?>
            <h3><u>Consent:</u></h3>
            <p>Has consented</p><br>
            <?php
            echo $onlineVisibility;
            ?>
        </div>
        <div class="side" style="left: 4%;">
            <p>Don't like your username or password?</p>
            <a href="https://www.ghscomputerscience.co.uk/Tom/ProfileStats/Changes/username.php">
                <button id="changeUsername">Change Username:</button>
            </a>
            <a href="https://www.ghscomputerscience.co.uk/Tom/ProfileStats/Changes/password.php">
                <button id="changePassword">Change Password:</button>
            </a>
        </div>
        <div class="boxGrouping">
            <div class="infoBox" style="top: 20%;">
                <?php
                echo $avgScore;
                ?>
            </div>
            <div class="infoBox" style="top: 40%;">
                <?php
                echo $topScore;
                ?>
            </div>
            <div class="infoBox" style="top: 60%;">
                <?php
                echo $totals;
                ?>
            </div>
        </div>

    </div>


</body>

</html>