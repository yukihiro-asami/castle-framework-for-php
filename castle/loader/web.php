<?php
include('libs/load.php');
$commands = [
    'get_syslog_id',
    'capture_server',
    'process_request_uri',
    'capture_dir',
    'config_setup',
    'set_up_core_classes',
    'store_syslog'
];
$__results = [];
$__vals = [];
$__body = '';
$__status = CSL_HTTP_STATUS_CODE_200_OK;
$__headers = [];
$__cookies = [];
$__dbs = [];
foreach ($commands as $command)
{
    $closure = include('closures/' . $command . '.php');
    $__results[$command] = $closure($__vals);
}