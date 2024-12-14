var wordindex = 0;
var incorrect = 0;
var correct = 0;

const input = document.getElementById("enterBox");
input.addEventListener("keydown",textBoxPress);
function textBoxPress(x) {
    console.log(x.key);
}
