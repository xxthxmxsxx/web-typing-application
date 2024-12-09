<?php
include '../conn.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $consent = $_POST['ageverification'];
    $salt = "ComplexSaltingIsOccuring";
    $hashed_password = hash('sha512', $password . $salt);

    $capitalArray = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
    $numArray = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
    $containCapital = false;
    $containNum = false;
    foreach ($capitalArray as $x) {
        if (strpos($password, $x) == true) {
            $containCapital = true;
            break;
        }
    }
    foreach ($numArray as $x) {
        if (strpos($password, $x) == true) {
            $containNum = true;
            break;
        }
    }
    $sql = "SELECT * FROM AccountDB WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($consent == false) {
        echo "<script>alert('Cannot make account without consent');</script>";
    } elseif ($result->num_rows > 0) {
        echo "<script>alert('This username already exists, please enter a different one');</script>";
    } elseif (strlen($password) < 8 && $containCapital != true && $containNum != true) {
        echo "<script>alert('Password does not meet standards');</script>";
    } else {
        $sql = "INSERT INTO AccountDB (username, password, consent) VALUES ('$username', '$hashed_password','$consent')";
        $conn->query($sql);
        echo "<script>alert('Account added successfully');</script>";
    }
}
?>

<html>

<head>
    <link rel="stylesheet" href="../format.css">
</head>

<body class="background">
    <div class="heading">
        <h1>Thometheus Typing</h1>
    </div>
    <div class="LogRegImg" style="left: 3%;">
        <img src="accountmaker.png" width="80%" height="80%">
    </div>
    <div class="side" style="right: 5%;">
        <form method="post">
            <label for="username">Username</label><br>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Password</label><br>
            <input type="text" id="password" name="password" requred><br><br>
            <label for="ageverification">Over 13 or Have parental consent?</label>
            <input type="checkbox" id="ageverification" name="ageverification" required><br>
            <input type="Submit" value="submit">
        </form>
        <div class="side" style="right: 5%;">
            <p>Already have an account?</p>
            <a href="https://www.ghscomputerscience.co.uk/Tom/LoginRegister/login.php">
                <button id="submitRegister">Login here</button>
            </a>
        </div>
    </div>
</body>

</html>