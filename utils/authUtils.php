<?php

	function getAuthorizationHeader(){
		$headers = null;
		if (isset($_SERVER['Authorization'])) {
		    $headers = trim($_SERVER["Authorization"]);
		}
		else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
		    $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
		} elseif (function_exists('apache_request_headers')) {
		    $requestHeaders = apache_request_headers();
		    $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
		    if (isset($requestHeaders['Authorization'])) {
		        $headers = trim($requestHeaders['Authorization']);
		    }
		}
		return $headers;
	}
	
	function getBearerToken() {
	    $headers = getAuthorizationHeader();
	    if (!empty($headers)) {
	        if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
	            return $matches[1];
	        }
	    }
	    return null;
	}

	function getUser($token, $exitOnWrongToken = true) {
		$users = getUserWithToken($token);
		if (count($users) > 0) {
			return $users[0];
		}else if ($exitOnWrongToken) {
			responseError("invalid token", 401);
        	exit();
		}else {
			return null;
		}
	}