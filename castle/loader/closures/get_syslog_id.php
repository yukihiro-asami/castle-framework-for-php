<?php
namespace castle;
return function (array &$vals) : string
{
    $vals[''] = generate_token();
    return 'success';
};