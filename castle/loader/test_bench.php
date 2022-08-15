<?php
include('libs/load.php');

$commands = <<<EOF
capture_dir
config_setup
capture_server
register_shutdown_function
test_bench
EOF;

$__results = [];
$__vals = [];
$__body = '';
foreach (explode(PHP_EOL, $commands) as $command)
{
    $closure = include('closures/' . $command . '.php');
    $__results[$command] = $closure($__vals);
}