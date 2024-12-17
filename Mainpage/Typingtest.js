var wordindex = 0;
var correct = 0;
var seconds = 0;
var timerHasStarted = false;
var startTime = 0;
var endTime = 0;
var timeTaken = 0;
var submittable = false;
var score = 0.0;

const input = document.getElementById("enterBox");
input.addEventListener("keydown", textBoxPress);
document.getElementById(wordindex).style.color = "rgb(0, 0, 0)"

var interval = setInterval(updateSeconds, 1000);

function updateSeconds() {
    seconds++;
}
function wordRecolour(wordEntered, word) {
    if (wordEntered == word.textContent) {
        correct++;
        document.getElementById(wordindex).style.color = "rgb(30, 255, 0)";
    } else {
        document.getElementById(wordindex).style.color = "rgb(255, 0, 0)";
    }
}

function textBoxPress(keyPressEvent) {
    if (wordindex == 30) {
        alert("Typing test ended");
        return;
    }
    if (!timerHasStarted) {
        startTime = seconds;
        timerHasStarted = true;
    }
    interval = setInterval
    const word = document.getElementById(wordindex);
    var wordEntered = document.getElementById("enterBox").value.trim();
    if (keyPressEvent.key == " ") {
        wordRecolour(wordEntered, word);
        document.getElementById("enterBox").value = "";
        wordindex++;
        if (wordindex != 30) {
            document.getElementById(wordindex).style.color = "rgb(0, 0, 0)";
        } else {
            endTime = seconds;
            timerHasStarted = false;
            submittable = true;
            timeTaken = endTime - startTime;
            score = correct / (timeTaken / 60)
        }

    }
}

function submitTest() {
    if (!submittable) {
        alert("Cannot be submitted");
        return;
    }
    submittable = false;
    console.log(timeTaken)
    console.log(score)
    var dataToSend = "timeTaken=" + encodeURIComponent(timeTaken) + "&score=" + encodeURIComponent(score);
    var request = new XMLHttpRequest();
    request.open("POST", "Typingtest.php", true); // try delete true? if not, it's probably async
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(dataToSend);
}

