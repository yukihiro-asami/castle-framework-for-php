<?php
namespace castle;
class Castle
{
    protected function _request_uri() : string
    {
        return $this->_value(__FUNCTION__);
    }
    protected function _value(string $function_name) : string|array
    {
        $key = substr($function_name, 1);
        global $__vals;
        return $__vals[$key];
    }
}