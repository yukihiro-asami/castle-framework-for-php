<?php
echo __NAMESPACE__ . 'phpunit' .  PHP_EOL;
include('libs/load.php');
$commands = <<<EOF
capture_dir
config_setup
set_up_core_classes
register_app_auto_loader
set_up_database
EOF;
global $__results, $__vals, $__body, $__protocol, $__status, $__headers, $__cookies, $__dbs;
/** @noinspection DuplicatedCode */
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
/** @noinspection PhpIgnoredClassAliasDeclaration */
class_alias('PHPUnit\Framework\TestCase', 'TestCase');
