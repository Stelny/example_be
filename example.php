<?php

	require_once('utils/authUtils.php');
	//require_once('utils/dbRequests.php');
	require_once('utils/printUtils.php');

	//VALIDATION
	$token = getBearerToken();
	print_r($token);
	//$user = getUser($token);
	

	$REQUIRED_PARAMS = array();
    include 'utils/validation.php';

    //ENDPOINT LOGIC

	print_r($user);