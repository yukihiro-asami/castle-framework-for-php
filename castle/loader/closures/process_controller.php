<?php
namespace castle;
return function (array &$vals) : string
{
    $obj = new \Controller_Hoge();
    $html = $obj->hoge();
    store_body($html);
    return 'success';
};