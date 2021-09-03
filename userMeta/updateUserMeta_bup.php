<?php

	include_once '../includes.php';

	//VALIDATION

	$token = getBearerToken();
	$user = getUser($token);

	$REQUIRED_PARAMS = array("key", "value");
    include '../utils/validation.php';

    //ENDPOINT LOGIC

    $metaKeys = getMetaKey($_POST["key"]);
    if (count($metaKeys) < 1) {
		responseError("invalid meta key", 401);
    }

	$userMeta = getUserMeta($_POST["key"], $user["id"]);
	if (count($userMeta) > 0) {
		updateUserMeta($_POST["key"], $_POST["value"], $user["id"]);
		response(array('message' => "updated"));
	} else {
		insertUserMeta($_POST["key"], $_POST["value"], $user["id"]);
		response(array('message' => "added"));
	}