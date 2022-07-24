<?php
namespace castle;
class Castle
{
    protected function _log_info(\Throwable|string $message) : void
    {
        static::_log($message, '__INFO__');
    }
    protected function _log(\Throwable|string $message, string $lebel) : void
    {
        if ($message instanceof \Throwable)
        {
            $logging_message = $message->getMessage() . ' ' . static::_value('_syslog_id') . PHP_EOL
            . 'throwed at file ' . $message->getFile() . ' at line ' . $message->getLine() . PHP_EOL;
        } else {
            $logging_message = $message . PHP_EOL;
        }
        \castle\log(\castle\date_formatted() . ' '. $lebel . ' ' . $logging_message, static::_value('_log_file_path'));
    }
    protected static function _request_uri() : string
    {
        return static::_value(__FUNCTION__);
    }
    protected static function _value(string $function_name) : string|array
    {
        $key = substr($function_name, 1);
        global $__vals;
        return $__vals[$key];
    }
}