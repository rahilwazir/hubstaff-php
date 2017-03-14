<?php 
	namespace Hubstaff\Client
	{
		class organizations
		{
			public function getorganizations($auth_token, $app_token, $offset, $url)
			{
				$fields["Auth-Token"] = $auth_token;
				$fields["App-token"] = $app_token;
				$fields["offset"] = $offset;
	
				$parameters["Auth-Token"] = "header";
				$parameters["App-token"] = "header";
				$parameters["offset"] = "";
				
				$curl = new curl;
	
				$org_data = json_decode($curl->send($fields, $parameters, $url));		
				return $org_data;	
			}
			public function find_organization($auth_token, $app_token, $url)
			{
				$fields["Auth-Token"] = $auth_token;
				$fields["App-token"] = $app_token;
	
				$parameters["Auth-Token"] = "header";
				$parameters["App-token"] = "header";
				
				$curl = new curl;
	
				$org_data = json_decode($curl->send($fields, $parameters, $url));	
				return $org_data;		
			}
			public function find_org_projects($auth_token, $app_token, $offset, $url)
			{
				$fields["Auth-Token"] = $auth_token;
				$fields["App-token"] = $app_token;
				$fields["offset"] = $offset;
	
				$parameters["Auth-Token"] = "header";
				$parameters["App-token"] = "header";
				$parameters["offset"] = "";
				
				$curl = new curl;
	
				$org_data = json_decode($curl->send($fields, $parameters, $url));		
				return $org_data;	
			}
			public function find_org_members($auth_token, $app_token, $offset, $url)
			{
				$fields["Auth-Token"] = $auth_token;
				$fields["App-token"] = $app_token;
				$fields["offset"] = $offset;
	
				$parameters["Auth-Token"] = "header";
				$parameters["App-token"] = "header";
				$parameters["offset"] = "";
				
				$curl = new curl;
	
				$org_data = json_decode($curl->send($fields, $parameters, $url));		
				return $org_data;	
			}
		}
	}
?>