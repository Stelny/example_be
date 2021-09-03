<?php

  include "../utils/cors.php";

  $method = $_SERVER['REQUEST_METHOD'];

	switch ($method) {
  		case 'GET':
    		include 'getUserMeta.php';
    		break;
  		case 'POST':
    		include 'updateUserMeta.php';
    		break;
  		default:
    		http_response_code(400);
    		break;
	}