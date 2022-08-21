<?php
namespace castle;
use Throwable;

return function (array &$vals) : string
{
    $path_processed_alias = $vals['path'];
    foreach ($vals['routes'] as $alias => $path)
    {
        if ($alias === $path_processed_alias)
            $path_processed_alias = $path;
    }
    $vals['path_processed_alias'] = $path_processed_alias;
    $path_array = explode('/', ltrim($path_processed_alias, '/'));
    array_unshift($path_array, 'controller');
    $vals['controller_array'] = $path_array;
    $vals['controller_path'] = $vals['app_classes_dir'] . implode('/', $path_array) . '.php';
    $class_array = array_map(fn($string) => ucfirst($string), $path_array);
    $vals['controller'] = implode("_", $class_array);
    try {
        if (file_exists($vals['controller_path']))
        {
            include $vals['controller_path'];
            $controller = new $vals['controller']();
            $vals['controller_method'] = strtolower($vals['method']) . '_index';
            $vals['is_controller_callable'] = method_exists($controller, $vals['controller_method']);
        } else {
            $vals['is_controller_callable'] = false;
        }
    } /** @noinspection PhpUnusedLocalVariableInspection */ catch (Throwable $t) {
        $vals['is_controller_callable'] = false;
    }
    return 'success';
};