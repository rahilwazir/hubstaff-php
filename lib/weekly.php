<?php 
	namespace Hubstaff\Client
	{
		class weekly
		{
			public function weekly_team($auth_token, $app_token, $options, $url)
			{
				$fields["Auth-Token"] = $auth_token;
				$fields["App-token"] = $app_token;
				if(isset($options['date']))
				{
					$fields['date'] = $options['date'];
					$parameters["date"] = "";
				}
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
						
			
				$parameters["Auth-Token"] = "header";
				$parameters["App-token"] = "header";
				
				$curl = new curl;
				$org_data = json_decode($curl->send($fields, $parameters, $url));		
				return $org_data;	
			}
	
			public function weekly_my($auth_token, $app_token, $options, $url)
			{
				$fields["Auth-Token"] = $auth_token;
				$fields["App-token"] = $app_token;
				if(isset($options['date']))
				{
					$fields['date'] = $options['date'];
					$parameters["date"] = "";
				}
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
					
			
				$parameters["Auth-Token"] = "header";
				$parameters["App-token"] = "header";
				
				$curl = new curl;
	
				$org_data = json_decode($curl->send($fields, $parameters, $url));		
				return $org_data;	
			}
	
		}
	}

?>