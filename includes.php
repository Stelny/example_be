<?php

	header('Access-Control-Allow-Origin: *');
	header("Access-Control-Allow-Methods: HEAD, GET, POST, PUT, PATCH, DELETE, OPTIONS");
	header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
	header('Content-Type: application/json');

	require_once('../utils/authUtils.php');
	require_once('../utils/db.php');
	require_once('../utils/dbUtils.php');
	require_once('../utils/dbRequests.php');
	require_once('../utils/printUtils.php');
	require_once('../utils/uploadUtils.php');
	require_once('../utils/mailUtils.php');