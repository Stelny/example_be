<?php

	include_once '../includes.php';

	//VALIDATION

	$token = getBearerToken();
	$user = getUser($token);

	$REQUIRED_PARAMS = array();
    include '../utils/validation.php';

    //ENDPOINT LOGIC

    $values = json_decode($_POST["values"]);
    foreach ($values as $key => $value) {
    	$metaItem = (array)$value;

    	$metaKeys = getMetaKey($metaItem["key"]);
	    if (count($metaKeys) < 1) {
			responseError("invalid meta key", 401);
	    }

		$userMeta = getUserMeta($metaItem["key"], $user["id"]);
		if (count($userMeta) > 0) {
			updateUserMeta($metaItem["key"], $metaItem["value"], $user["id"]);
		} else {
			insertUserMeta($metaItem["key"], $metaItem["value"], $user["id"]);
		}
    }

    $userMeta = getUserMetas($user["id"]);
    response($userMeta);