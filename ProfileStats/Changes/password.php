<?php
session_start();
ob_start();
include '../../conn.php';
$ID = $_SESSION['UserID'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    $salt = "ComplexSaltingIsOccuring";
    $currentHashedPassword = hash('sha512', $currentPassword . $salt);
    $newHashedPassword = hash('sha512', $newPassword . $salt);

    if ($newPassword = $confirmPassword) {
        if ($newHashedPassword != $currentHashedPassword) {
            $result = $conn->query("SELECT * FROM AccountDB WHERE username = '$username' AND password = '$currentHashedPassword' AND ID = '$ID'");
            if ($result->num_rows > 0) {
                $conn->query("UPDATE AccountDB SET password = '$newHashedPassword' WHERE ID = '$ID'");
                header('Location:../profile.php');
                exit;
            } else {
                echo "<script>alert('Current username and password do not match');</script>";
            }
        } else {
            echo "<script>alert('These passwords do not match each other');</script>";
        }
    } else {
        echo "<script>alert('New password confirmation failure');</script>";
    }
}
?>

<html>

<head>
    <link rel="stylesheet" href="../../format.css">
</head>

<body>
    <div class="side" style="left: 28%; top:15%;">
        <form method="post">
            <label for="username">Username</label><br>
            <input type="text" id="username" name="username" required><br>
            <label for="currentPassword">Current password</label><br>
            <input type="text" id="currentPassword" name="currentPassword" requred><br><br>
            <label for="newPassword">New password</label><br>
            <input type="text" id="newPassword" name="newPassword" requred><br><br>
            <label for="confirmPassword">Confirm new password</label><br>
            <input type="text" id="confirmPassword" name="confirmPassword" requred><br>
            <input type="Submit" value="submit">
        </form>
        <div class="side">
            <p>Change your mind? Click here to return</p>
            <a href="https://www.ghscomputerscience.co.uk/Tom/ProfileStats/profile.php">
                <button id="return">Go back</button>
            </a>
        </div>
    </div>
</body>

</html>