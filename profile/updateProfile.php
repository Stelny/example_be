<?php

    include_once '../includes.php';

    //VALIDATION

    $token = getBearerToken();
	$user = getUser($token);

    $REQUIRED_PARAMS = array("name", "surname", "bio", "phone", "region_id");
    include '../utils/validation.php';

    //ENDPOINT LOGIC

    if (strlen($_POST["name"]) < 2 || strpos($_POST["name"], " ")) {
        responseError("invalid name", 400);
        exit();
    }

    if (strlen($_POST["surname"]) < 2 || strpos($_POST["surname"], " ")) {
        responseError("invalid surname", 400);
        exit();
    }

    if (!is_numeric($_POST["phone"]) || strlen($_POST["phone"]) != 9) {
        responseError("invalid phone number", 400);
        exit();
    }

    $region = getRegion($_POST["region_id"]);
    if (empty($region)) {
        responseError("invalid region", 400);
        exit();
    }

    updateUser($user["id"], $_POST["name"], $_POST["surname"], $_POST["bio"], $_POST["phone"], $_POST["region_id"]);
    $user = getUserWithEmail($user["email"])[0];
    response($user);