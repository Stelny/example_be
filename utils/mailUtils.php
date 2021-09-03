<?php

require './../vendor/autoload.php';
require_once 'const.php';

use Mailgun\Mailgun;

function sendEmailWithTemplate($template, $to, $subject, $params = [1]) {

    $settings = [
        'from'    => 'no-reply@gigz.cz',
        'to'      => $to,
        'subject' => $subject,
        'template' => $template,
    ];

    foreach ($params as $key => $value) {
        $settings[$key] = $value;
    }

    $mg = Mailgun::create(MAILGUN_API_KEY, MAILGUN_ENDPOINT); // For US servers
    $mg->messages()->send(MAILGUN_DOMAIN, $settings);
}

//sendEmailWithTemplate("test", "czechnyancatcat@gmail.com", "Testik maligun");