<?php 
	namespace Hubstaff\Client
	{
		class projects
		{
			public function getprojects($auth_token, $app_token, $status, $offset , $url)
			{
				$fields["Auth-Token"] = $auth_token;
				$fields["App-token"] = $app_token;
				$fields["offset"] = $offset;
				if($status)
					$fields["status"] = $status;
	
				$parameters["Auth-Token"] = "header";
				$parameters["App-token"] = "header";
				$parameters["offset"] = "";
				if($status)
					$parameters["status"] = "";
				
				$curl = new curl;
	
				$proj_data = json_decode($curl->send($fields, $parameters, $url));		
				return $proj_data;	
			}
			public function find_project($auth_token, $app_token, $url)
			{
				$fields["Auth-Token"] = $auth_token;
				$fields["App-token"] = $app_token;
	
				$parameters["Auth-Token"] = "header";
				$parameters["App-token"] = "header";
				
				$curl = new curl;
	
				$proj_data = json_decode($curl->send($fields, $parameters, $url));	
				return $proj_data;		
			}
			public function find_project_members($auth_token, $app_token, $offset, $url)
			{
				$fields["Auth-Token"] = $auth_token;
				$fields["App-token"] = $app_token;
				$fields["offset"] = $offset;
	
				$parameters["Auth-Token"] = "header";
				$parameters["App-token"] = "header";
				$parameters["offset"] = "";
				
				$curl = new curl;
	
				$proj_data = json_decode($curl->send($fields, $parameters, $url));		
				return $proj_data;	
			}
		}
	}

?>