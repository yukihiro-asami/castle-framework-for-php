<?php
namespace castle;
return function (array &$vals) : string
{
    register_shutdown_function(
        function ()
        {
            global $__body;
            echo $__body;
        }
    );
    return 'success';
};