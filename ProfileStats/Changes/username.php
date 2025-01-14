<?php
session_start();
ob_start();
include '../../conn.php';
$ID = $_SESSION['UserID'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currentUsername = $_POST['currentUsername'];
    $password = $_POST['password'];
    $newUsername = $_POST['newUsername'];
    $confirmUsername = $_POST['confirmUsername'];

    $salt = "ComplexSaltingIsOccuring";
    $hashedPassword = hash('sha512', $password . $salt);

    if ($newUsername == $confirmUsername) {
        if ($newUsername != $currentUsername) {
            $result = $conn->query("SELECT * FROM AccountDB WHERE username = '$currentUsername' AND password = '$hashedPassword' AND ID = '$ID'");
            if ($result->num_rows > 0) {
                $conn->query("UPDATE AccountDB SET username = '$newUsername' WHERE ID = '$ID'");
                header('Location:../profile.php');
                exit;
            } else {
                echo "<script>alert('Current username and password do not match');</script>";
            }
        } else {
            echo "<script>alert('The new username cannot be the same as the current');</script>";
        }
    } else {
        echo "<script>alert('New username confirmation failure');</script>";
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
            <label for="currentUsername">Current username</label><br>
            <input type="text" id="currentUsername" name="currentUsername" required><br>
            <label for="password">Password</label><br>
            <input type="text" id="password" name="password" requred><br><br>
            <label for="newUsername">New username</label><br>
            <input type="text" id="newUsername" name="newUsername" requred><br><br>
            <label for="confirmUsername">Confirm new username</label><br>
            <input type="text" id="confirmUsername" name="confirmUsername" requred><br>
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