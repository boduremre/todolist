<?php

function get_logged_user()
{
    $t = &get_instance();
    $user = $t->session->userdata("username");
    if ($user)
        return $user;
    else
        return false;
}

// https://stackoverflow.com/questions/28012011/how-to-obtain-location-from-ipinfo-io-in-php
function getClientIP(){
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function ip_details($ip) {
    $json = file_get_contents("https://ipinfo.io/{$ip}/geo");
    $details = json_decode($json, true);
    return $details;
}

?>