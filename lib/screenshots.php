<?php 
	namespace Hubstaff\Client
	{
		class screenshots
		{
			public function getscreenshots($auth_token, $app_token, $starttime, $endtime, $offset, $options, $url)
			{
				$fields["Auth-Token"] = $auth_token;
				$fields["App-token"] = $app_token;
				$fields["start_time"] = $starttime;
				$fields["stop_time"] = $endtime;
	
				if(isset($options['organizations']))
				{
					$fields['organizations'] = $options['organizations'];
					$parameters["organizations"] = "";
				}
				if(isset($options['projects']))
				{
					$fields['projects'] = $options['projects'];
					$parameters["projects"] = "";
				}
				if(isset($options['users']))
				{
					$fields['users'] = $options['users'];
					$parameters["users"] = "";
				}
				
				$fields["offset"] = $offset;
			
				$parameters["Auth-Token"] = "header";
				$parameters["App-token"] = "header";
				$parameters["start_time"] = "";
				$parameters["stop_time"] = "";
				$parameters["offset"] = "";
				
				$curl = new curl;
				$screenshots_data = json_decode($curl->send($fields, $parameters, $url));	
				return $screenshots_data;	
			}
		}
	}
?>