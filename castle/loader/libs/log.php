<?php
namespace castle;
const MESSAGE_TYPE = 3;
function log(string $message, $path) : bool
{
    try {
        error_log($message, 3, $path);
        return true;
    } catch (\Throwable $t) {
        return false;
    }
}