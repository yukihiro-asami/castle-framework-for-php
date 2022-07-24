<?php
namespace castle;
class Controller extends Castle
{
    function hoge(){
        echo '_in_hoge' . '<br>';
        static::_log_info(new \Exception('hogehoge'));
    }
}