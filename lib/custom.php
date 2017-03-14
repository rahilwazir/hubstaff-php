<?php 
	namespace Hubstaff\Client
	{
		class custom
		{
			public function custom_report($auth_token, $app_token, $start_date, $end_date, $options, $url)
			{
				$fields["Auth-Token"] = $auth_token;
				$fields["App-token"] = $app_token;
				$fields["start_date"] = $start_date;
				$fields["end_date"] = $end_date;
	
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
				if(isset($options['show_tasks']))
				{
					$fields['show_tasks'] = $options['show_tasks'];
					$parameters["show_tasks"] = "";
				}
				if(isset($options['show_notes']))
				{
					$fields['show_notes'] = $options['show_notes'];
					$parameters["show_notes"] = "";
				}
				if(isset($options['show_activity']))
				{
					$fields['show_activity'] = $options['show_activity'];
					$parameters["show_activity"] = "";
				}
				if(isset($options['include_archived']))
				{
					$fields['include_archived'] = $options['include_archived'];
					$parameters["include_archived"] = "";
				}
				
	
				$parameters["Auth-Token"] = "header";
				$parameters["App-token"] = "header";
				$parameters["start_date"] = "";
				$parameters["end_date"] = "";
				
				$curl = new curl;
				$custom_data = json_decode($curl->send($fields, $parameters, $url));		
				return $custom_data;	
			}
	
	
	
		}
	}

?>