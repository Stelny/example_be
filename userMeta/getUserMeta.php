<?php

	include_once '../includes.php';

	//VALIDATION

	$token = getBearerToken();
	$user = getUser($token);

	$REQUIRED_PARAMS = array();
    include '../utils/validation.php';

    //ENDPOINT LOGIC
    if (!array_key_exists("key", $_GET)) {
    	responseError("key param missing", 400);
    }
    htmlspecialchars($_GET["key"]);
	$userMeta = getUserMeta($_GET["key"], $user["id"]);
	response($userMeta);