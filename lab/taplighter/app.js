var score = 0;
$(function(){
	var timer = 1000;
	$("#tap").click(function(){
		$(this).fadeOut(200);
		$("#game .life div").stop().animate({width: "-=" + ($("body").css("width").replace("px", "") / 8.5) + "px"}, timer);
		setInterval(function(){
			if(parseInt($("#game .life div").css("width").replace("px", "")) <= $("body").css("width").replace("px", "") / 8.5){
				gameover();
			}else {
				$("#game .life div").stop().animate({width: "-=" + ($("body").css("width").replace("px", "") / 8.5) + "px"}, timer);
			}
		}, timer);
	});

	var colors = ["1abc9c", "2ecc71", "3498db", "9b59b6", "34495e", "f1c40f", "e67e22", "e74c3c", "95a5a6"];
	var random;
	$("#game").click(function(event){
		if($(event.target).is(".light")){
			score++;
			timer -= 3000;
			random = Math.floor(Math.random() * 9);
			if($("body").css("width").replace("px", "") - 28 > parseInt($("#game .life div").css("width").replace("px", "")) + $("body").css("width").replace("px", "") / 8.5){
				$("#game .life div").stop().animate({width: "+=" + $("body").css("width").replace("px", "") / 14.5}, $("body").css("width").replace("px", "") / 8.5);
			}
			$("#game .score").text(score);
			$("#game").css("background-color", "#" + colors[random]);
			if(Math.floor(Math.random() * 2) == 1){
				$("#game .light").css("left", "0");
			}else {
				$("#game .light").css("left", "50%");
			}
		}else {
			gameover();
		}
	});

	$("#gameover").click(function(){
		location.reload();
	})
});

function gameover(){
	$("#game").fadeOut(150);
	$("#gameover table tr td:nth-child(2)").text(score);
}