<?php

	include_once '../includes.php';

	//VALIDATION

    if (!array_key_exists("id", $_GET)) {
	    $token = getBearerToken();
	    $user = getUser($token);
    }

	$REQUIRED_PARAMS = array();
    include '../utils/validation.php';

    //ENDPOINT LOGIC

    if (array_key_exists("id", $_GET)) {
    	$user = getUserWithId($_GET["id"]);
    	if (count($user) < 1) {
    		responseError("no user with given id", 400);
    		exit();
    	} else {
    		$user = $user[0];
    	}
    }

	$extras = getUserMetas($user["id"]);
	$user["extras"] = $extras;
	$photos = getPhotos($user["id"]);
	$user["photos"] = $photos;
    $verified = getVerifiedCode($user["id"]);
    if (count($verified) < 1) {
        $user["verified"] = false;
    } else {
        $user["verified"] = true;
    }
    $avgRating = getAverageRatingForUser($user["id"]);
    if (count($avgRating) < 1) {
        $user["avg_rating"] = null;
    } else {
        $user["avg_rating"] = $avgRating[0]["avg"];
    }
    unset($user["password"]);
	response($user);