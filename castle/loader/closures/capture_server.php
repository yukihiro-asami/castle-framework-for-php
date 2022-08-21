<?php
namespace castle;
return function (array &$vals) : string
{
    $vals['captured_server_value'] = $_SERVER;
    $vals['accept_language'] = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
    $vals['host'] = $_SERVER['HTTP_HOST'];
    $vals['castle_environment_value'] = $_SERVER['CSL_ENV'] ?? '';
    $vals['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
    $vals['content_type'] = $_SERVER['CONTENT_TYPE'] ?? '';
    $vals['remote_addr'] = $_SERVER['REMOTE_ADDR'];
    $vals['request_uri'] = $_SERVER['REQUEST_URI'];
    $vals['request_method'] = $_SERVER['REQUEST_METHOD'];
    $vals['server_protocol'] = $_SERVER['SERVER_PROTOCOL'];
    $vals['https'] = $_SERVER['HTTPS'] ?? '';
    $vals['http_x_forwarded_photo'] = $_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '';
    $vals['http_x_forwarded_port'] = $_SERVER['HTTP_X_FORWARDED_PORT'] ?? '';
    $vals['http_x_requested_with'] = $_SERVER['HTTP_X_REQUESTED_WITH'] ?? '';
    $vals['http_x_cluster_client_ip'] = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'] ?? '';
    $vals['http_x_forwarded_for'] = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? '';
    $vals['http_x_method_override'] = $_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'] ?? '';
    $vals['method'] = $vals['security.allow_x_headers']
        ? _empty_next($vals['http_x_method_override'],  $vals['request_method'], 'GET')
        : _empty_next($vals['request_method'], 'GET');
    $vals['is_https_on'] = $vals['https'] !== '';
    /** @noinspection HttpUrlsUsage */
    $vals['url_base'] = $vals['is_https_on'] ? 'https://' : 'http://' . $vals['host'];
    return 'success';
};