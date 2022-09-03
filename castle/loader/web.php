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
set_up_database
register_exception_handler
register_error_handler
register_shutdown_function
process_controller
process_controller_with_value
execute_controller
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

echo 'dbs in web<br>';
print_r($__dbs);
