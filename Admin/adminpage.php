<?php
session_start();
ob_start();
include '../conn.php';
$ID = $_SESSION['UserID'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredID = $_POST['enteredID'];
    $record = $conn->query("SELECT * FROM AccountDB WHERE ID = '$enteredID'");
    if ($record->num_rows > 0) {
        $accountData = $record->fetch_assoc();
        if ($accountData['enabled'] == "1") {
            echo "<script>alert('This account is already enabled');</script>";
        } else {
            $conn->query("UPDATE AccountDB SET enabled = '1', counter='0' WHERE ID = '$enteredID'");
            echo "<script>alert('Change has been made');</script>";
            header("Refresh: 0");
            exit;
        }
    } else {
        echo "<script>alert('Account by this ID does not exist');</script>";
    }
}

$result = $conn->query("SELECT ID, username, enabled, enabled FROM AccountDB");
$htmlStats = array();

while ($row = mysqli_fetch_assoc($result)){
    if ($row['enabled'] == 1) {
        $enabledStatus = "<p style='color:green; display: inline;'>enabled</p>";
    } else {
        $enabledStatus = "<p style='color:red; display: inline;'>disabled</p>";
    }
    $html = "<div>ID of ".$row['ID'].",  ".$row['username']." has a current status of = ".$enabledStatus."</div>";
    $htmlInfo[] = $html;
    }


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
        <h2 style="text-align: center;">This page is for admins only! Below is the current states of all accounts, please reenable them if requested by the user!</h2>
    </div>
    <div class="adminSettingsBox">
        <?php
        foreach ($htmlInfo as $line) {
        echo $line;
        } ?>
    </div>
    <div class="adminSubmit">
        <form method="post">
            <label for="enteredID">Enter the ID of the account you would like to reenabled</label><br>
            <input type="text" id="enteredID" name="enteredID" requred><br><br>
            <input type="Submit" value="submit">
        </form>
    </div>
</body>

</html>