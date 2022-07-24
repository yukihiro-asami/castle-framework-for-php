<?php
namespace castle;
function store_body(string $html) : bool
{
    try {
        global $__body;
        $__body = $html;
        return true;
    } catch (\Throwable $t) {
        return false;
    }
}