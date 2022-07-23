<?php

echo __DIR__;

include('libs/load.php');
$commands = [
    'capture_dir'
];

$__results = [];
$__vals = [];
$__body = '';


foreach ($commands as $command)
{
    $closure = include('closures/' . $command . '.php');
    $__results[$command] = $closure($__vals);
}

echo str_replace(PHP_EOL, '<br>', json_encode($__vals, JSON_PRETTY_PRINT));