<?php
namespace castle;
const MESSAGE_TYPE = 3;
function log(string $message, $path) : bool
{
    try {
        error_log($message, $path);
        return true;
    } catch (\Throwable $t) {
        return false;
    }
}