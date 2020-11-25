<?php
header("Content-Type: application/json; charset=UTF-8");
//error_reporting(E_NONE);
include("token.php");
//To be changed according to userdata:

$discord_api_loggin		= false;





$discord_api_url 		= "https://dreieichcon.de/";

$curl_header			= array(
							'Authorization: Token ' . $token
						);

$data['token'] = $token;
						
echo(api_perform_get_request($data, "2020/api/fetchquestions" ));


/*
*******************************************************************************************************************************************
*******************************************************************************************************************************************
Global API Functionality
*******************************************************************************************************************************************
*******************************************************************************************************************************************
*/



function api_perform_get_request($data, $discord_api_endpoint){
	global $discord_api_loggin, $discord_api_url, $discord_api_token;
	
	$url = $discord_api_url.$discord_api_endpoint;
	
	$first = true;
	foreach($data as $key=>$value){
		if($first){
			$url .= "?".$key."=".$value;
			$first = false;
		}else{
			$url .= "&".$key."=".$value;
		}
	}
	
	$url = str_replace(' ', '%20', $url);
	
	$curl = curl_init();
	
	
	if($discord_api_loggin){
		echo"<pre>";
		echo"
		====================================
		=== perform get request via api ===
		====================================\n";
		echo"URL: $url\n";
		echo"== Submitted data ==\n";
		print_r($data, true);
		echo"\n\n";
		
		//Enable Loggin
		curl_setopt($curl, CURLOPT_VERBOSE, true);
		$verbose = fopen('php://temp', 'w+');
		curl_setopt($curl, CURLOPT_STDERR, $verbose);
	}
	
	
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);      
	
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_USERAGENT, "conservices.de Webserver");
	
	$response = curl_exec($curl);
	
	if ($response === FALSE) {
    printf("cUrl error (#%d): %s<br>\n", curl_errno($curl),
           htmlspecialchars(curl_error($curl)));
	}

	if($discord_api_loggin){
		echo"== Verbose Logging API Connection ==\n";
		
		rewind($verbose);
		$verboseLog = stream_get_contents($verbose);

		echo (htmlspecialchars($verboseLog));
		echo"\n";
	}
	
   
   curl_close($curl);
   
   
	if($discord_api_loggin){
		
		echo"== API Result ==\n";
		
		echo $response;
		echo"\n";
		echo " === End perform GET request ===\n\n\n\n\n</pre>";
	}
   
   return $response;
   
	
}







function api_perform_post_request($data, $discord_api_endpoint ){
	
	global $discord_api_loggin, $discord_api_url, $discord_api_token;
	
	$url = $discord_api_url.$discord_api_endpoint;

	$curl = curl_init($url);

	
	if($discord_api_loggin){
		echo"<pre>";
		echo"
		====================================
		=== perform post request via api ===
		====================================\n";
		echo"URL: $url\n";
		echo"== Submitted data ==\n";
		echo $data;
		echo"\n\n";
		
		//Enable Loggin
		curl_setopt($curl, CURLOPT_VERBOSE, true);
		$verbose = fopen('php://temp', 'w+');
		curl_setopt($curl, CURLOPT_STDERR, $verbose);
	}


	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);                                                                  
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);                                                                      
	curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',
		'Authorization: Token ' . $discord_api_token, 		
		'Content-Length: ' . strlen($data))                                                                       
	);                                                     
	
//Execute cURL
	$result = curl_exec($curl);
   
   
    if ($result === FALSE) {
    printf("cUrl error (#%d): %s<br>\n", curl_errno($curl),
           htmlspecialchars(curl_error($curl)));
	}

	if($discord_api_loggin){
		echo"== Verbose Logging API Connection ==\n";
		
		rewind($verbose);
		$verboseLog = stream_get_contents($verbose);

		echo (htmlspecialchars($verboseLog));
		echo"\n";
	}
	
   
   curl_close($curl);
   
   
	if($discord_api_loggin){
		
		echo"== API Result ==\n";
		
		echo $result;
		echo"\n";
		echo " === End perform post request ===\n\n\n\n\n</pre>";
	}
   
   return $result;
   
	
}


?>