<?php
namespace castle;
function _empty_next(?string ...$values) : string
{
    foreach ($values as $value)
    {
        if ($value === '' OR $value === NULL)
            continue;
        return $value;
    }
    return '';
}