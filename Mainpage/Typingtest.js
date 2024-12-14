var wordindex = 0;
var incorrect = 0;
var correct = 0;

const input = document.getElementById("enterBox");
input.addEventListener("keydown",textBoxPress);
function textBoxPress(x) {
    const word = document.getElementById(wordindex);
    console.log(word.textContent)
    if (x.key == " " && wordindex != 29){
        wordindex ++;
    }

}
