<?php

	foreach ($REQUIRED_PARAMS as $param) {
        if (array_key_exists($param, $_POST) AND $_POST[$param] != null) {
            $_POST[$param] = htmlspecialchars($_POST[$param]);
        } else {
            http_response_code(400);
            $response = array();
            $response["error"] = $param . " param missing";
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            exit();
        }
    }