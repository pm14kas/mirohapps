var gamefield = document.getElementById("game");
gamefield.width = document.body.clientWidth-5;
gamefield.height = document.body.clientHeight-5;
var gf = gamefield.getContext("2d");
var fps = 60;
var rectWidth = 20;
var rectHeight = 20;
var total = gamefield.width * gamefield.height;
var updateSpeed = Math.sqrt(total);

window.addEventListener('resize', drawField, false);

function drawField() {
	gamefield.width = document.body.clientWidth-5;
	gamefield.height = document.body.clientHeight-5;
	total = gamefield.width * gamefield.height;
	updateSpeed = Math.sqrt(total);
    for (var i = 0; i < gamefield.width; i += rectWidth) {
        for (var j = 0; j < gamefield.height; j += rectHeight) {
            gf.fillStyle = "#" + (Math.round(Math.random() * 100)).toString() + (Math.round(Math.random() * 100)).toString() + (Math.round(Math.random() * 100)).toString();
            gf.fillRect(i, j, rectWidth, rectHeight);
            gf.fill();
        }
    }
}

drawField();
redrawField();


function redrawField() { 
	for (var cnt = 0; cnt < updateSpeed; cnt += 1) { 
		/*var i = (Math.round(Math.random() * total / rectWidth)); 
		i = i - i % rectWidth; 
		var j = (Math.round(Math.random() * total / rectHeight)); 
		j = j - j % rectHeight; */
		var i = (Math.round(Math.random() * total / rectWidth / rectHeight));
        i = i - i % rectWidth;
        var j = (Math.round(Math.random() * total / rectWidth / rectHeight));
        j = j - j % rectHeight;
        gf.fillStyle = getRandomColor();
		gf.fillRect(i, j, rectWidth, rectHeight); 
		gf.fill(); 
	} 
}

/*function redrawField() {
    for (var cnt = 0; cnt < updateSpeed; cnt += 1) {
        var i = (Math.round(Math.random() * total / rectWidth / rectHeight));
        i = i - i % rectWidth;
        var j = (Math.round(Math.random() * total / rectWidth / rectHeight));
        j = j - j % rectHeight;
        gf.fillStyle = "#" + (Math.round(Math.random() * 100)).toString() + (Math.round(Math.random() * 100)).toString() + (Math.round(Math.random() * 100)).toString();
        gf.fillRect(i, j, rectWidth, rectHeight);
        gf.fill();
    }
}*/

function getRandomColor(){
	var colors = ['0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f'];
	var result = "#";
	for (var i = 0; i < 6; i++) {
		result+=colors[Math.round(Math.random()*16)];
	}
	return result;
}


setInterval("redrawField()", 1000 / fps);