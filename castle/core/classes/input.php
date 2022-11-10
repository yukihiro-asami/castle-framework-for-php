<?php /** @noinspection PhpUnused */
namespace castle;
class Input extends Castle
{
    static public function ip() : string
    {
        return static::_remote_addr();
    }

    static public function user_agent() : string
    {
        return static::_user_agent();
    }
}