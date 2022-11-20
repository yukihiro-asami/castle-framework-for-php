<?php /** @noinspection DuplicatedCode */
include('libs/load.php');
$commands = <<<EOF
capture_dir
config_setup
set_up_core_classes
process_cookie
register_app_auto_loader
set_up_database
execute_task
EOF;
global /** @noinspection DuplicatedCode */
$__mode, $__results, $__vals, $__body, $__protocol, $__status, $__headers, $__cookies, $__dbs, $__task_class_name;
$__mode = CSL_MODE_TASK;
$__results = [];
$__vals = [];
$__body = '';
$__protocol = 'HTTP/1.1';
$__status = CSL_HTTP_STATUS_CODE_200_OK;
$__headers = [];
$__cookies = [];
$__dbs = [];
$__db_logs = [];
$__credential = NULL;
$__task_class_name = $argv[1]  ?? NULL;
$__task_param = $argv[2] ?? NULL;
foreach (explode(PHP_EOL, $commands) as $command)
{
    /** @noinspection PhpIncludeInspection */
    $closure = include('closures/' . $command . '.php');
    $__results[$command] = $closure($__vals);
}