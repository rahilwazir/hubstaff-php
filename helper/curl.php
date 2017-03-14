<?php 
	namespace Hubstaff\Client
	{
		class curl
		{
			public function send($fields, $parameters, $url,$type = 0)
			{
				$post_string = '';
				$header_string = '';
				foreach($fields as $key=>$value) {
					 if($parameters[$key] == "header")
						 $header_string[] .= $key.': '.$value; 
					 else if($value)
						 $post_string .= $key.'='.urlencode($value).'&'; 
				}
				$post_string = rtrim($post_string,"&");
				$curl = curl_init();
				if(!$type)
				{
					curl_setopt($curl, CURLOPT_URL, $url.'?'.$post_string); 
				}
				else 
					curl_setopt($curl, CURLOPT_URL, $url); 
				curl_setopt($curl, CURLOPT_HTTPHEADER, $header_string);
				if($type)
				{
					curl_setopt($curl, CURLOPT_POST, count($fields));
					curl_setopt($curl, CURLOPT_POSTFIELDS, $post_string);
				}
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
				$result = curl_exec($curl);
				$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

				if($httpCode != 200 && $httpCode != 201 ) {
				  if( $httpCode == "400" || $httpCode == "401" || $httpCode == "403" || $httpCode == "404" || $httpCode == "406" || $httpCode == "409" || $httpCode == "429" || $httpCode == "500" || $httpCode == "502" || $httpCode == "403" )
				  {
				 	 $error = array("error" => curl_error($curl));
				  }else
				  {
					 $error = array("error" => "Unexpected Error from hubstaff-php");
				  }
				  return json_encode($error);
				}

				curl_close($curl);
				return $result;
			}
		}
	}
?>
