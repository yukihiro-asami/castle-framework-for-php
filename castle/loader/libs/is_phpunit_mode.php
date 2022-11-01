<?php
namespace castle;
function is_phpunit_mode() : bool
{
    global $__is_phpunit;
    if (isset($__is_phpunit))
    {
        return true;
    } else {
        return false;
    }
}