<?php /** @noinspection PhpParameterByRefIsNotUsedAsReferenceInspection */

namespace castle;
return function (array &$vals) : string
{
    $callback = function ($errno, $errstr, $errfile, $errline) use ($vals)
{
    $path = $vals['views_dir'] . 'castle/__503__.php';
    echo view(['message' => $errno . $errstr], $path);
    die;
};
    set_error_handler($callback);
    return 'success';
};