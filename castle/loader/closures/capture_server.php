<?php
namespace castle;
return function (array &$vals) : string
{
    $vals['captured_server_value'] = $_SERVER;
    $vals['accept_language'] = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
    $vals['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
    $vals['ip_address'] = $_SERVER['REMOTE_ADDR'];
    $vals['request_uri'] = $_SERVER['REQUEST_URI'];
    return 'success';
};