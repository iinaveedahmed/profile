<?php 
	if( true || $_POST)
	{
		require_once 'lib/purl_.php'; //curl library
		$data  	= $_REQUEST;
		$name  	= isset($data["name"])?$data["name"]:errme("Please enter your name");
		$email 	= isset($data["email"])?$data["email"]:errme("Please enter your email");
		$msg	= isset($data["comments"])?$data["comments"]:errme("Please enter your comments");

		$compose = "Mr/Ms ".$name." with email: ".$email." Sent the following message: \n\r".$msg;
		
		// mailer data.
		$dt = array( 
			'from' 		=> 'Web Mail <mail@inaveed.com>',
			'to'		=> 'Web Mail <mail@inaveed.com>',
			'subject'	=> $name.' through inaveed.com web form',
			'text'		=> $compose
		);

		$ch = curl_init();

		curl_setopt_array($ch, array(
		    CURLOPT_HTTPAUTH		=> CURLAUTH_BASIC,
		    CURLOPT_RETURNTRANSFER 	=> 1,
		    CURLOPT_CUSTOMREQUEST	=> 'POST'
			CURLOPT_POSTFIELDS 		=> implode('&', $dt)
		));

		$result = curl_exec($ch);

		curl_close($ch);

		//print_r($result);

		echo "Message successfully sent!";
	}

	function errme($v)
	{
		echo $v;
		die();
	}
?>
