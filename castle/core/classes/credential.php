<?php /** @noinspection PhpUnused */
namespace castle;
class Credential extends Castle
{
    CONST COOKIE_DELETE_SEC = 3600;

    static function set_cookie(string $cookie_name, array|string $value, $expiration = 3600) : bool
    {
        $value = is_array($value) ? json_encode($value) : $value;
        if (static::_is_cookie_encrypted())
            $value = secret_box($value, static::_cookie()['encrypt_key']);
        store_cookie($cookie_name, $value, time() + $expiration);
        return true;
    }

    static function get_cookie(string $cookie_name) : array|string
    {
        $cookie_value = array_key_exists($cookie_name, static::_captured_cookie_values()) ? static::_captured_cookie_values()[$cookie_name] : '';
        $cookie_value = static::_is_cookie_encrypted() ? secret_box_open($cookie_value, static::_cookie()['encrypt_key']) : $cookie_value;
        return json_decode($cookie_value, true) ?? $cookie_value;
    }

    static function delete_cookie(string $cookie_name) : bool
    {
        store_cookie($cookie_name, '', time() - static::COOKIE_DELETE_SEC);
        return true;
    }

    static function _is_cookie_encrypted() : bool
    {
        if (static::_cookie()['encrypt'] === false)
            return false;
        if (static::_castle_environment_value() === CSL_ENV_DEVELOPMENT)
            return false;
        return true;
    }
}