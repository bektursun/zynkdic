<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
	<title>Speak.js Demo</title>
	<script src="speakClient.js"></script>
	<script type="text/javascript" src="http://localhost/js/jquery.js"></script>
	<script>
	var period = 0;
	function beat_it() {
		if( period !== 0 ) {
			speak('beat', {pitch: 10});
			setTimeout(beat_it, period);
		}
	}
	function stop_the_beat() {
		period = 0;
	}
	function start_the_beat() {
		period = document.getElementById('beat-frequency').value;
		beat_it();
	}
	$(document).ready(function(){
		$('#doing').click(function(){
			var myText = $('#myTextarea');
			// console.log(myText.text());
			speak(myText.val());
		})
		
	});
	</script>
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
<textarea input="inputText" name="text" id="myTextarea" placeholder="Введите слово"></textarea>

	<div id="audio"></div>
	<input type="button" value="Say 'Hello'" id="doing" />
	<br>
	<br>
	<label for="">Beat frequency</label>
	<input id="beat-frequency" type="text" value="900" placeholder="Beat frequency (in miliseconds)'" />
	<br>
	<input type="button" onclick="start_the_beat()" value="Start The Beat!" />
	<br>
	<input type="button" onclick="stop_the_beat()" value="Stop The Beat!" />
</body>
</html>
