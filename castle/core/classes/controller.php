<?php
namespace castle;
class Controller extends Castle
{
    protected string $view_path = '';

    function __construct()
    {
        $class_array = explode('_', __CLASS__);
        array_shift($class_array);
        array_map(
            fn ($string) => mb_strtolower($string),
            $class_array
        );
        $this->view_path = static::_views_dir() . implode('/', $class_array);
    }
}