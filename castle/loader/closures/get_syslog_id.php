<?php
namespace castle;
return function (array &$vals) : string
{
    echo time() + 3600 . '<br>';
    echo $vals['syslog_id'] = generate_token('xuvVRxnDCw0ddjdK', 8) . '|' .dechex(time() + 3600);
    return 'success';
};