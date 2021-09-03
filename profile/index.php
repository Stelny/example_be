<?php

  include "../utils/cors.php";

  $method = $_SERVER['REQUEST_METHOD'];

	switch ($method) {
  		case 'GET':
    		include 'getProfile.php';
    		break;
      case 'POST':
        include 'updateProfile.php';
        break;
  		default:
    		http_response_code(400);
    		break;
	}