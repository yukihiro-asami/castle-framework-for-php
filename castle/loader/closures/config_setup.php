<?php
namespace castle;
const EXCLUDE_FILES = ['.', '..'];
return function (array &$vals) : string
{
    $config = [];
    foreach (scandir($vals['config_dir']) as $file_name)
    {
        if (in_array($file_name, EXCLUDE_FILES) === false)
        {
            $config[explode('\\', $file_name)[0]] = json_decode(file_get_contents($vals['config_dir'] . $file_name));
        }
    }
    $vals['captured_config'] = $config;
    return 'success';
};