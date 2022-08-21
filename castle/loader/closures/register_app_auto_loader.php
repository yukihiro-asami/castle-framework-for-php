<?php
namespace castle;
return function (array &$vals) : string
{
    spl_autoload_register(
        function ($class) use ($vals)
        {
            include $vals['app_classes_dir'] . class_name_to_filename($class);
        }
    );
    return 'success';
};