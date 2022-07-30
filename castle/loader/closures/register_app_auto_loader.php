<?php
namespace castle;
return function (array &$vals) : string
{
    spl_autoload_register(
        function (string $class_name) use ($vals)
        {
            include $vals['app_classes_dir'] . class_name_to_filename($class_name);
        }
    );
    return 'success';
};