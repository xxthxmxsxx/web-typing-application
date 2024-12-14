<?php
include '../conn.php';
$myfile = fopen("wordlist.txt", "r");
$content = fread($myfile, filesize("wordlist.txt"));
fclose($myfile);
$words = explode("\n", $content);
$testWords = array();
for ($x = 0; $x <= 29; $x++) {
    $num = rand(0, count($words));
    $testWords[] = $words[$num];
}
$htmlList = array();
$IDValue = 0;
foreach ($testWords as $singleWord) {
    $html = '<div class ="basicWord"><p id='.$IDValue.'>' . $singleWord . '</p></div>';
    $htmlList[] = $html;
    $IDValue = $IDValue + 1;
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
    <div class="subheading">
        <a class="leftsittingbutton" href="">
            <button id="Profile">Profile</button>
        </a>
        <a class="leftsittingbutton" href="">
            <button id="Stats">Stats</button>
        </a>
        <a class="rightsittingbutton" href="https://www.ghscomputerscience.co.uk/Tom/LoginRegister/login.php">
            <button id="LogOut">Log Out</button>
        </a>
        <a class="rightsittingbutton" href="https://www.ghscomputerscience.co.uk/Tom/Mainpage/Typingtest.php">
            <button id="Home">Home</button>
        </a>
    </div>
    <div>
        <div>
            <br>
            <p>Score:
            <p>
                <br><br>
                <input class="inputBox" type="text" id="enterBox" onfocus="this.value=''" value="Click to start">
        </div>
    </div>
    <div class="typingBox">
        <?php
        for ($x = 0; $x <= 29; $x++) {
            echo $htmlList[$x];
        } ?></p>
    </div>

</body>

</html>
<script src="Typingtest.js"></script>