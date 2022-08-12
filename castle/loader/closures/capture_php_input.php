<?php
namespace castle;
return function (array &$vals) : string
{
    $vals['captured_php_input'] = file_get_contents('php://input');
    if ($vals['content_type'] === CSL_MEDIA_TYPE_APPLICATION_JSON)
    {
        $vals['parsed_php_input'] = json_decode($vals['captured_php_input']);
    } else {
        $parsed_php_input = [];
        parse_str($vals['captured_php_input'], $parsed_php_input);
        $vals['parsed_php_input'] = $parsed_php_input;
    }
    return 'success';
};