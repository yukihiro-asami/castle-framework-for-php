<?php
include('libs/load.php');
$commands = [
    'get_syslog_id',
    'capture_dir',
    'config_setup',
    'set_up_core_classes'
];
$__results = [];
$__vals = [];
$__body = '';
foreach ($commands as $command)
{
    $closure = include('closures/' . $command . '.php');
    $__results[$command] = $closure($__vals);
}
$obj = new \castle\Controller();
$obj->hoge();

echo str_replace(PHP_EOL, '<br>', json_encode($__vals, JSON_PRETTY_PRINT));