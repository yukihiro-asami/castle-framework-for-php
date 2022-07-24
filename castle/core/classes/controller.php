<?php
namespace castle;
class Controller extends Castle
{
    function hoge(){
        echo $this->_request_uri();
    }
}