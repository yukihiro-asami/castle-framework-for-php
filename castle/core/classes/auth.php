<?php /** @noinspection PhpUnused */
namespace castle;
class Auth extends Castle
{

    static function check() : bool
    {
        return static::_credential_implement()->check();
    }

    static function get_user_id() : int
    {
        return static::_credential_implement()->get_user_id();
    }

    static function _credential_implement() : Credential0implement
    {
        global $__credential;
        return $__credential;
    }
}