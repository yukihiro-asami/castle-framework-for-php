<?php
namespace castle;
return function (array &$vals) : string
{
    $base_path =& $vals['core_classes_dir'];
    foreach (
        [
        'Castle',
        'Controller',
        'Controller_Hoge'
        ]
        as $class_name
    )
    {
        $path = mb_strtolower(str_replace('_', '/', $class_name));
        /** @noinspection PhpIncludeInspection */
        include($base_path . $path . '.php');
        class_alias('\\castle\\' . ucfirst($class_name), '\\' . ucfirst($class_name));
    }
    return 'success';
};