<?php
namespace castle;
include('libs/load.php');
$commands = [
    'get_syslog_id'
];
$results = [];
$vals = [];

foreach ($commands as $command)
{
    $closure = include('closures/' . $command . '.php');
    $results[$command] = $closure($vals);
}

var_dump($results);
var_dump($vals);