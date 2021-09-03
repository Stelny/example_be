<?php

	function responseError($message, $code = 400) {
		$response = array(
			'status' => "error",
			'message' => $message,
		);
		http_response_code($code);
		echo json_encode($response);
		exit();
	}

	function response($response) {
		http_response_code(200);
		echo json_encode($response);
		exit();
	}

	function responseOk() {
		$response = array(
			'status' => "ok"
		);
		http_response_code(200);
		echo json_encode($response);
		exit();
	}