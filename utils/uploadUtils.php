<?php

require './../vendor/autoload.php';
require 'const.php';

function settingsSpace()  {
    $key = DIGITALOCEAN_API_KEY;
    $secret = DIGITALOCEAN_SECRET;

    $space_name = DIGITALOCEAN_SPACE_NAME;
    $region = DIGITAL_OCEAN_REGION;

    $my_space = Spaces($key, $secret)->space($space_name, $region);
    return $my_space;
}

function uploadImage($file, $name, $folder_name = "/") {

    $my_space = settingsSpace();
    $my_space->uploadFile($file, 'uploads' . $folder_name . '/' . $name, "public");
}
