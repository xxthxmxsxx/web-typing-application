<?php
session_start();
include '../conn.php';
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $ID = $_SESSION['UserID'];
    $result = $conn->query("SELECT score, dateOfAttempt FROM HistoryDB WHERE ID = '$ID' ORDER BY AttemptID DESC LIMIT 30");
    $htmlList = array();
    while ($row = mysqli_fetch_assoc($result)){
        $html = "<div>".$row['score']." achieved on ".$row['dateOfAttempt']."</div><br>";
        $htmlList[] = $html;
   }
}
//SELECT HistoryDB.score, HistoryDB.dateOfAttempt, AccountDB.username FROM HistoryDB LEFT JOIN AccountDB ON HistoryDB.ID = AccountDB.ID WHERE AccountDB.onlineVisibility = 1 ORDER BY HistoryDB.score DESC LIMIT 3
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
        <div class="side" style="left: 5%;">
            <?php
            foreach ($htmlList as $line) {
                echo $line;
            } ?>
        </div>
        <div class="side" style="right: 5%;">

        </div>
    </div>

</body>

</html>