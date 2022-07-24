<?php
namespace castle;
return function (array &$vals) : string
{
    echo file_get_contents($vals['syslog_dir'] . 'hogehoge.json');
    return 'success';
};