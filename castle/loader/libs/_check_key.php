<?php
namespace castle;
function _check_key(array $array, $key) : array|string|int|float
{
    if (isset($array[$key]) === true)
    {
        return $array[$key];
    } else {
        return '';
    }
}