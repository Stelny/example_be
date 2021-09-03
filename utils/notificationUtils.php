<?php

    use paragraph1\phpFCM\Client;
    use paragraph1\phpFCM\Message;
    use paragraph1\phpFCM\Recipient\Device;
    use paragraph1\phpFCM\Notification;

    require_once '../vendor/autoload.php';
    require_once 'const.php';

    
function sendNotification($title, $body, $device, $icon = "https://cdn.svetkrmiv.cz/images/0/30301ea454ef1f97/2/mame-stene-jake-hracky-mu-vybrat-aby-ho-bavily-ale-neublizily-mu.png") {
    $apiKey = FIREBASE_API_KEY;
    $client = new Client();
    $client->setApiKey($apiKey);
    $client->injectHttpClient(new \GuzzleHttp\Client());

    $note = new Notification($title, $body);
    $note->setIcon($icon)
        ->setColor('#ffffff')
        ->setBadge(1);

    $message = new Message();
    $message->addRecipient(new Device($device));
    $message->setNotification($note);
        //->setData(array('someId' => 111));

    $response = $client->send($message);
    if ($response->getStatusCode() == "200") {
        return true;
    }
    return false;
}   

var_dump(sendNotification("test", "kontent", "fuYrPD9IeWcDTD4UOQrPVp:APA91bEA8sFLWHaMRDQD5PfMNcbDbseeBN_X_EccOCQmOoM5Xe1DHEfXqIrshReUzGjttCvN_fGO9AS3FnxCYJ0pbOnfLUDWeAoJb7hY4u5kmAlrbs1MnaI-jHKFKVv-INv0KjSvqCwr"));
    