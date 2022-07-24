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
            $config[explode('.', $file_name)[0]] = json_decode(file_get_contents($vals['config_dir'] . $file_name), true);
        }
    }
    $vals['captured_config'] = $config;
    print_r($config);
    $vals['log_file_path'] = $config['castle']['log_file_path'];
    return 'success';
};