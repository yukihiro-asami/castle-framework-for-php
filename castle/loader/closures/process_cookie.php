<?php
namespace castle;

return function (array &$vals) : string
{
    if (is_phpunit_mode() === true)
    {
        $vals['captured_cookie_values'] = [];
    } else{
        $vals['captured_cookie_values'] = $_COOKIE;
    }
    return 'success';
};