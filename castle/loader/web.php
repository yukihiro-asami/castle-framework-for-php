<?php
namespace castle;
include('libs/load.php');

hoge('loaded');

$commands = [
    'hoge'
];
$results = [];
$vals = [];

foreach ($commands as $command)
{
    $closure = include('closures/' . $command . '.php');
    $results[$command] = $closure($vals);
}