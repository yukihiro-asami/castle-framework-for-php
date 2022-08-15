<?php
include('libs/load.php');
$commands = <<<EOF
get_syslog_id
capture_dir
config_setup
capture_server
process_request_uri
capture_php_input
process_params
set_up_core_classes
register_app_auto_loader
register_shutdown_function
process_controller
store_syslog
EOF;

$__results = [];
$__vals = [];
$__body = '';
$__protocol = 'HTTP/1.1';
$__status = CSL_HTTP_STATUS_CODE_200_OK;
$__headers = [];
$__cookies = [];
$__dbs = [];

foreach (explode(PHP_EOL, $commands) as $command)
{
    $closure = include('closures/' . $command . '.php');
    $__results[$command] = $closure($__vals);
}

foreach ($__vals as $key => $val)
{
    echo $key . '<br>';
    print_r($val);
    echo '<br>';
}
