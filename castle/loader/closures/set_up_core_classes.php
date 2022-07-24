<?php
namespace castle;
return function (array &$vals) : string
{
    $base_path =& $vals['core_classes_dir'];
    foreach (
        [
        'castle',
        'controller'
        ]
        as $class_name
    )
    {
        /** @noinspection PhpIncludeInspection */
        include($base_path . $class_name . '.php');
        class_alias('\\castle\\' . ucfirst($class_name), '\\' . ucfirst($class_name));
    }
    return 'success';
};