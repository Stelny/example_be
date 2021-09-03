<?php

	//AUTH

	function getUsersWithCredentials($email, $password) {
		$query = 'SELECT * FROM `user` WHERE `email` = :email AND `password` = :password';
		$dataArray = array(
			':email' => $email,
			':password' => $password
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function getUserWithId($id) {
		$query = 'SELECT * FROM `user` WHERE `id` = :id';
		$dataArray = array(
			':id' => $id
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function insertToken($token, $userId) {
		$query = 'INSERT INTO `token` (`id`, `token`, `created`, `expiration`, `user_id`) VALUES (NULL, :token, :created, :expiration, :userId)';
		$expiration = date("Y-m-d", strtotime("+1 month", strtotime(date('Y-m-d H:i:s'))));
		$dataArray = array(
			':token' => $token,
			':created' => date('Y-m-d H:i:s'),
			':expiration' => $expiration,
			':userId' => $userId
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function getUserWithToken($token) {
		$query = 'SELECT * FROM `user` WHERE `id` = (SELECT user_id FROM `token` WHERE token = :token AND expiration >= CURDATE())';
		$dataArray = array(
			':token' => $token,
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function getUserWithEmail($email) {
		$query = 'SELECT * FROM `user` WHERE `email` = :email';
		$dataArray = array(
			':email' => $email,
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function insertUser($name, $surname, $bio, $email, $phone, $password, $type, $regionId) {
		$salt1 = '!+D["-*nwf7Q!F';
		$salt2 = '#g3`~Tw[V\}6,gkB';
		$query = 'INSERT INTO `user` (`id`, `name`, `surname`, `bio`, `email`, `phone`, `password`, `type`, `region_id`, `created`,`visibility`) VALUES (NULL, :name, :surname, :bio, :email, :phone, :password, :type, :regionId, :created, 1)';
		$dataArray = array(
			':name' => $name,
			':surname' => $surname,
			':bio' => $bio,
			':email' => $email,
			':phone' => $phone,
			':password' => hash("sha512", $salt1 . $password . $salt2),
			':type' => $type,
			':regionId' => $regionId,
			':created' => date("Y-m-d H:i:s")
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function updateUser($id, $name, $surname, $bio, $phone, $regionId) {
		$query = 'UPDATE `user` SET `name` = :name, `surname` = :surname, `bio` = :bio, `phone` = :phone, `region_id` = :regionId WHERE `id` = :id;';
		$dataArray = array(
			':id' => $id,
			':name' => $name,
			':surname' => $surname,
			':bio' => $bio,
			':phone' => $phone,
			':regionId' => $regionId
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	//META KEY

	function getMetaKey($key) {
		$query = 'SELECT * FROM `meta_key` WHERE `key` = :key';
		$dataArray = array(
			':key' => $key
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	//USER META

	function getUserMetas($userId) {
		$query = 'SELECT * FROM `user_meta` WHERE `user_id` = :userId';
		$dataArray = array(
			':userId' => $userId,
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function getUserMeta($key, $userId) {
		$query = 'SELECT * FROM `user_meta` WHERE `user_id` = :userId AND `key` = :key';
		$dataArray = array(
			':userId' => $userId,
			':key' => $key
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function insertUserMeta($key, $value, $userId) {
		$query = 'INSERT INTO `user_meta` (`id`, `key`, `value`, `user_id`) VALUES (NULL, :key, :value, :userId);';
		$dataArray = array(
			':key' => $key,
			':value' => $value,
			':userId' => $userId
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function updateUserMeta($key, $value, $userId) {
		$query = 'UPDATE `user_meta` SET `value` = :value WHERE `key` = :key AND `user_id` = :userId;';
		$dataArray = array(
			':key' => $key,
			':value' => $value,
			':userId' => $userId
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	//GIG META

	function getGigMetas($gigId) {
		$query = 'SELECT * FROM `gig_meta` WHERE `gig_id` = :gigId';
		$dataArray = array(
			':gigId' => $gigId,
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function getGigMeta($key, $gigId) {
		$query = 'SELECT * FROM `gig_meta` WHERE `gig_id` = :gigId AND `key` = :key';
		$dataArray = array(
			':gigId' => $gigId,
			':key' => $key
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function insertGigMeta($key, $value, $gigId) {
		$query = 'INSERT INTO `gig_meta` (`id`, `key`, `value`, `gig_id`) VALUES (NULL, :key, :value, :gigId);';
		$dataArray = array(
			':key' => $key,
			':value' => $value,
			':gigId' => $gigId
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function updateGigMeta($key, $value, $gigId) {
		$query = 'UPDATE `gig_meta` SET `value` = :value WHERE `key` = :key AND `gig_id` = :gigId;';
		$dataArray = array(
			':key' => $key,
			':value' => $value,
			':gigId' => $gigId
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	//CATEGORIES

	function getCategories() {
		$query = 'SELECT * FROM `category`';
		$dataArray = array();
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function getCategory($id) {
		$query = 'SELECT * FROM `category` WHERE `id` = :id';
		$dataArray = array(
			':id' => $id
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	//GIG CATEGORY

	function getGigCategories($gigId) {
		$query = 'SELECT `gig_category`.`category_id` AS "id", (SELECT `category`.`name` FROM `category` WHERE `category`.`id` = `gig_category`.`category_id`) AS "name" FROM `gig_category` WHERE `gig_id` = :gigId';
		$dataArray = array(
			':gigId' => $gigId,
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function insertGigCategory($gigId, $categoryId) {
		$query = 'INSERT INTO `gig_category` (`gig_id`, `category_id`) VALUES (:gigId, :categoryId);';
		$dataArray = array(
			':gigId' => $gigId,
			':categoryId' => $categoryId
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function deleteGigCategories($gigId) {
		$query = 'DELETE FROM `gig_category` WHERE `gig_id` = :gigId;';
		$dataArray = array(
			':gigId' => $gigId
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	//SUBCATEGORIES

	function getSubcategories() {
		$query = 'SELECT * FROM `subcategory`';
		$dataArray = array();
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function getSubcategory($id) {
		$query = 'SELECT * FROM `subcategory` WHERE `id` = :id';
		$dataArray = array(
			':id' => $id,
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	//REGIONS

	function getRegions() {
		$query = 'SELECT * FROM `region`';
		$dataArray = array();
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function getRegion($id) {
		$query = 'SELECT * FROM `region` WHERE `id` = :id';
		$dataArray = array(
			':id' => $id,
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	//GIGS

	function getGigs($category = [], $order = "",$page = 0, $coordinates = [], $search = "") {
		$query = 'SELECT * FROM `gig`';
		$dataArray = array();
 
		//Search 
		if ($search) {
			$query .= " WHERE title LIKE '%" . $search . "%'";
		}


		//Coordinates
		$coordinatesExist = false;
		if (count($coordinates) > 0) {
			
			$query .= " ORDER BY ((lat-:lat)*(lat-:lat)) + ((lng - :lng)*(lng - :lng)) ASC";
			$lat = $coordinates[0];
			$lng = $coordinates[1];
			$dataArray[':lng'] = $lng;
			$dataArray[':lat'] = $lat;
			$coordinatesExist = true;
		}

		//order

		if ($order) {
			$pre = !$coordinatesExist ? " ORDER BY" : ",";
			$order == "cheap" && $pal = $pre . " price ASC";

			if ($order == 'new') {
				$pal = $pre . " id ASC";
			} else {
				if ($order != 'cheap') {
					$pal = $pre . " id DESC";
				}
			}
			$query .= $pal;
		}
		
		
		//Page
		if ($page != "") {
			$query .= " LIMIT " . $page . " OFFSET 0";
		}

		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function getGig($id) {
		$query = 'SELECT * FROM `gig` WHERE `id` = :id';
		$dataArray = array(
			':id' => $id
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function getGigsByUserId($user_id) {
		$query = 'SELECT * FROM `gig` WHERE `user_id` = :user_id';
		$dataArray = array(
			':user_id' => $user_id
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function getLatestUserGig($userId) {
		$query = 'SELECT * FROM `gig` WHERE `user_id` = :userId ORDER BY id DESC LIMIT 1';
		$dataArray = array(
			':userId' => $userId
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function getLastGigId() {
		$query = 'SELECT id FROM `gig` ORDER BY id DESC LIMIT 1';
		$dataArray = array();
		$result = sendDbRequest($query, $dataArray);
		return $result[0]["id"];
	}

	function getGigWithUserId($id, $userId) {
		$query = 'SELECT * FROM `gig` WHERE `user_id` = :userId AND `id` = :id LIMIT 1';
		$dataArray = array(
			':id' => $id,
			':userId' => $userId
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function insertGig($title, $text, $price, $type, $lat, $lng, $placeName, $userId, $subcategoryId) {
		$query = 'INSERT INTO `gig` (`id`, `title`, `text`, `price`, `type`, `lat`, `lng`, `place_name`,`user_id`, `subcategory_id`) VALUES (NULL, :title, :text, :price, :type, :lat, :lng, :place_name, :userId, :subcategoryId);';
		$dataArray = array(
			':title' => $title,
			':text' => $text,
			':price' => $price,
			':type' => $type,
			':lat' => $lat,
			':lng' => $lng,
			':place_name' => $placeName,
			':userId' => $userId,
			':subcategoryId' => $subcategoryId
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function updateGig($id, $title, $text, $price, $type, $lat, $lng, $placeName, $subcategoryId) {
		$query = 'UPDATE `gig` SET `title` = :title, `text` = :text, `price` = :price, `type` = :type, `lat` = :lat, `lng` = :lng, `place_name` = :place_name, `subcategory_id` = :subcategoryId WHERE `id` = :id;';
		$dataArray = array(
			':id' => $id,
			':title' => $title,
			':text' => $text,
			':price' => $price,
			':type' => $type,
			':lat' => $lat,
			':lng' => $lng,
			':place_name' => $placeName,
			':subcategoryId' => $subcategoryId
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function deleteGig($id, $userId) {
		$query = 'DELETE FROM `gig` WHERE `id` = :id AND `user_id` = :userId';
		$dataArray = array(
			':id' => $id,
			':userId' => $userId
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	//GIG TYPES

	function getGigType($id) {
		$query = 'SELECT * FROM `gig_type` WHERE `id` = :id';
		$dataArray = array(
			':id' => $id
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	//UPLOADS

	function getPhotos($userId) {
		$query = 'SELECT * FROM `photo` WHERE `user_id` = :userId';
		$dataArray = array(
			':userId' => $userId
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function getPhoto($key, $userId) {
		$query = 'SELECT * FROM `photo` WHERE `key` = :key AND `user_id` = :userId';
		$dataArray = array(
			':key' => $key,
			':userId' => $userId
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function updatePhoto($key, $path, $userId) {
		$query = 'UPDATE `photo` SET `path` = :path WHERE `key` = :key AND `user_id` = :userId;';
		$dataArray = array(
			':key' => $key,
			':path' => $path,
			':userId' => $userId
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function insertPhoto($key, $path, $userId) {
		$query = 'INSERT INTO `photo` (`id`, `key`, `path`, `user_id`) VALUES (NULL, :key, :path, :userId);';
		$dataArray = array(
			':key' => $key,
			':path' => $path,
			':userId' => $userId
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function deletePhoto($key, $userId) {
		$query = 'DELETE FROM `photo` WHERE `key` = :key AND `user_id` = :userId;';
		$dataArray = array(
			':key' => $key,
			':userId' => $userId
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}


	//GIG UPLOADS

	function getGigPhoto($id) {
		$query = 'SELECT * FROM `gig_photo` WHERE `id` = :id';
		$dataArray = array(
			':id' => $id
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function getGigPhotos($gigId) {
		$query = 'SELECT * FROM `gig_photo` WHERE `gig_id` = :gigId';
		$dataArray = array(
			':gigId' => $gigId
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function insertGigPhoto($path, $gigId) {
		$query = 'INSERT INTO `gig_photo` (`id`, `path`, `gig_id`) VALUES (NULL, :path, :gigId);';
		$dataArray = array(
			':path' => $path,
			':gigId' => $gigId
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function deleteGigPhoto($id) {
		$query = 'DELETE FROM `gig_photo` WHERE `id` = :id';
		$dataArray = array(
			':id' => $id
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	//RATINGS

	function getRatings($forUserId) {
		$query = 'SELECT * FROM `rating` WHERE `for_user_id` = :forUserId;';
		$dataArray = array(
			':forUserId' => $forUserId
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function getRatingByGigId($gigId) {
		$query = 'SELECT * FROM `rating` WHERE `gig_id` = :gig_id;';
		$dataArray = array(
			':gig_id' => $gigId
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function getLastRating($forUserId, $gigId, $userId) {
		$query = 'SELECT * FROM `rating` WHERE `for_user_id` = :forUserId AND `gig_id` = :gigId AND `user_id` = :userId ORDER BY id DESC LIMIT 1';
		$dataArray = array(
			':forUserId' => $forUserId,
			':gigId' => $gigId,
			':userId' => $userId
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function getRating($id, $userId) {
		$query = 'SELECT * FROM `rating` WHERE `id` = :id  AND `user_id` = :userId;';
		$dataArray = array(
			':id' => $id,
			':userId' => $userId
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function getAverageRatingForUser($forUserId) {
		$query = 'SELECT AVG(`stars`) AS "avg" FROM `rating` WHERE `for_user_id` = :forUserId';
		$dataArray = array(
			':forUserId' => $forUserId
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function getAverageRatingForGig($gigId) {
		$query = 'SELECT AVG(`stars`) AS "avg" FROM `rating` WHERE `gig_id` = :gigId;';
		$dataArray = array(
			':gigId' => $gigId
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function insertRating($text, $stars, $forUserId, $gigId, $userId) {
		$query = 'INSERT INTO `rating` (`id`, `text`, `stars`, `for_user_id`, `gig_id`, `user_id`) VALUES (NULL, :text, :stars, :forUserId, :gigId, :userId);';
		$dataArray = array(
			':text' => $text,
			':stars' => $stars,
			':forUserId' => $forUserId,
			':gigId' => $gigId,
			':userId' => $userId
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function deleteRating($id, $userId) {
		$query = 'DELETE FROM `rating` WHERE `id` = :id AND `user_id` = :userId;';
		$dataArray = array(
			':id' => $id,
			':userId' => $userId
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function updateRating($text, $stars, $id) {
		$query = 'UPDATE `rating` SET `text` = :text, `stars` = :stars WHERE `id` = :id;';
		$dataArray = array(
			':id' => $id,
			':stars' => $stars,
			':text' => $text
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	//USER VERIFY CODE

	function getVerifiedCode($userId) {
		$query = 'SELECT * FROM `user_verify_code` WHERE `user_id` = :userId AND `verified` = 1;';
		$dataArray = array(
			':userId' => $userId
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function getVerifyCode($code) {
		$query = 'SELECT * FROM `user_verify_code` WHERE `code` = :code;';
		$dataArray = array(
			':code' => $code
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function insertVerifyCode($code, $userId) {
		$query = 'INSERT INTO `user_verify_code` (`id`, `code`, `user_id`, `verified`) VALUES (NULL, :code, :userId, 0);';
		$dataArray = array(
			':code' => $code,
			':userId' => $userId
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function updateVerifyCode($code, $verified) {
		$query = 'UPDATE `user_verify_code` SET `verified` = :verified WHERE `code` = :code;';
		$dataArray = array(
			':code' => $code,
			':verified' => $verified
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	//Favorite 

	function getFavorite($userId) {
		$query = 'SELECT * FROM `favorite` WHERE `user_id` = :userId';
		$dataArray = array(
			':userId' => $userId
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function deleteFavoriteById($id) {
		$query = 'DELETE FROM `favorite` WHERE `id` = :id';
		$dataArray = array(
			':id' => $id
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function deleteFavorite($userId, $gigId) {
		$query = 'DELETE FROM `favorite` WHERE `gig_id` = :gigId AND `user_id` = :userId';
		$dataArray = array(
			':gigId' => $gigId,
			':userId' => $userId
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function isFavoriteExist($userId, $gigId) {
		$query = 'SELECT * FROM `favorite` WHERE `gig_id` = :gigId AND `user_id` = :userId';
		$dataArray = array(
			':gigId' => $gigId,
			':userId' => $userId
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	function insertFavorite($user_id, $gig_id) {
		$query = 'INSERT INTO `favorite` (`user_id`, `gig_id`) VALUES (:userId, :gigId)';
		$dataArray = array(
			':userId' => $user_id,
			':gigId' => $gig_id
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	//DEVICES
	function insertFCMDevices($user_id, $device_id) {
		$query = 'INSERT INTO `devices` (`user_id`, `device_id`) VALUES (:userId, :deviceId)';
		$dataArray = array(
			':userId' => $user_id,
			':deviceId' => $device_id
		);
		$result = sendDbRequest($query, $dataArray);
		return $result;
	}

	