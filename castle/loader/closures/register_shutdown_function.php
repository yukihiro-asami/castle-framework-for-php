<?php
namespace castle;
return function (array &$vals) : string
{
    global $__protocol;
    $__protocol = _empty_next($vals['server_protocol'], $__protocol);
    register_shutdown_function(
        function ()
        {
            global $__body;
            echo $__body;
        }
    );
    return 'success';
};