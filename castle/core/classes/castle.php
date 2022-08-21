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
            $logging_message = $message->getMessage() . ' s_id:' . static::_value('syslog_id') . PHP_EOL
            . 'throwed at file ' . $message->getFile() . ' at line ' . $message->getLine() . PHP_EOL;
        } else {
            $logging_message = $message . ' s_id:' . static::_value('syslog_id') . PHP_EOL;
        }
        \castle\log(\castle\date_formatted() . ' '. $lebel . ' ' . $logging_message, static::_value('_log_file_path'));
    }
    protected static function _request_uri() : string
    {
        return static::_value(__FUNCTION__);
    }
    protected static function _url_base() : string
    {
        return static::_value(__FUNCTION__);
    }
    protected static function _path() : string
    {
        return static::_value(__FUNCTION__);
    }
    protected static function _views_dir() : string
    {
        return static::_value(__FUNCTION__);
    }
    protected static function _value(string $key_or_file_name) : string|array
    {
        $key = str_starts_with($key_or_file_name, '_') === true ? substr($key_or_file_name, 1) : $key_or_file_name;
        global $__vals;
        return $__vals[$key];
    }
}