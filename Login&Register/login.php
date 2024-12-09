<?php
include '../conn.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $salt = "ComplexSaltingIsOccuring";
    $hashed_password = hash('sha512', $password . $salt);

    $usernameSQL = "SELECT * FROM AccountDB WHERE username = '$username'";
    $exists = $conn->query($usernameSQL);
    if ($exists->num_rows > 0) {
        $sql = "SELECT * FROM AccountDB WHERE username = '$username' AND password = '$hashed_password' AND enabled = true";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $conn->query("UPDATE AccountDB SET counter = 0 WHERE username = '$username'");
            header("Location: ____");
            exit;
        } else {
            echo "<script>alert('These credentials are no longer valid, too many attempts will result in the account being disabled');</script>";
            $conn->query("UPDATE AccountDB SET counter = counter +1 WHERE username = '$username'");
            $counterValue = $conn->query("SELECT counter FROM AccountDB WHERE username='$username'");
            $value = $counterValue->fetch_assoc();
            if ($value['counter'] > 5) {
                $conn->query("UPDATE AccountDB SET enabled = false WHERE username ='$username'");
                echo "<script>alert('This account has been disabled, please contact an admin');</script>";
            }
        }
    } else {
        echo "<script>alert('This user does not exist');</script>";
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
    <div class="LogRegImg" style="right: 5%;">
        <img src="keyboard.png" width="100%" height="60%">
    </div>
    <div class="side" style="left: 5%;">
        <form method="post">
            <label for="username">Username</label><br>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Password</label><br>
            <input type="text" id="password" name="password" requred><br><br>
            <input type="Submit" value="submit">Submit</input>
        </form>
        <div class="side" style="left: 5%;">
            <p>Already have an account?</p>
            <a href="https://www.ghscomputerscience.co.uk/Tom/LoginRegister/register.php">
                <button id="sumbitLogin">Login here</button>
            </a>
        </div>
    </div>
</body>

</html>