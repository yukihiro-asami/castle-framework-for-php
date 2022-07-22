<?php
namespace castle;
return function (array &$vals) : string
{
    $vals['syslog_id'] = generate_token();
    return 'success';
};