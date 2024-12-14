var wordindex = 0;
var correct = 0; 

const input = document.getElementById("enterBox");
input.addEventListener("keydown",textBoxPress);
document.getElementById(wordindex).style.color = "rgb(0, 0, 0)"

function wordRecolour(wordEntered, word){
    if (wordEntered == word.textContent){
        correct ++;
        document.getElementById(wordindex).style.color = "rgb(30, 255, 0)";
    } else {
        document.getElementById(wordindex).style.color = "rgb(255, 0, 0)";
    }
}

function textBoxPress(x) {
    if (wordindex == 30) {
        alert("Typing test ended");
        return;
    }
    const word = document.getElementById(wordindex);
    var wordEntered = document.getElementById("enterBox").value.trim();
    if (x.key == " ") {
        wordRecolour(wordEntered, word);
        document.getElementById("enterBox").value = "";
        wordindex ++;
        if (wordindex != 30){
            document.getElementById(wordindex).style.color = "rgb(0, 0, 0)";
        }
        
    } 
}
