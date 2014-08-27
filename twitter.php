<?php
	header('Content-type: application/json; charset=utf8');
	header("access-control-allow-origin: *");
	
	require 'twitteroauth/twitteroauth.php';
	$consumer_key = '51Aqv0bBqJwuSku4xOHw';
	$consumer_secret = 'sD6ZZQLnX3utGPDUGO4Nln8AEYcJ7BMpanL8j3bQbk';
	$access_token = '113720384-MqjXUAFx8ymgL99v6kXW8ijGHgLYlWQVeCXJu7ca';
	$access_token_secret = '1R5mKAwf4jSfBX6og9kLOjLeRGBIYToS58AL3tH5C64x4';
	$twitter = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);
	$username = isset($_GET['username']) ? htmlspecialchars($_GET['username']) : NULL;
	$count = isset($_GET['count']) ? (int) $_GET['count'] : 5;
	
	$tweets = $twitter->get('https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name='.$username.'&count='.$count);

	if(isset( $tweets->errors[0]->code)){
		echo "Error encountered: ".$tweets->errors[0]->message." Response code:" .$tweets->errors[0]->code;
	}else {
		$file = "tweets.txt";
		$fh = fopen($file, 'w') or die("can't open file");
		fwrite($fh, json_encode($tweets));
		fclose($fh);

		if(file_exists($file)){
			echo $file." successfully written (".round(filesize($file)/1024)."KB)";
		}else {
			echo "Error encountered. File could not be written.";
		}
	}
?>