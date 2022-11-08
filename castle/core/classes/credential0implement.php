<?php /** @noinspection PhpUnused */
namespace castle;
use Throwable;

class Credential0implement extends Castle
{
    CONST COOKIE_DELETE_SEC = 3600;
    CONST MAX_PASSWORD_LENGTH = 128;
    public string $_user_table_name;
    public string $_session_table_name;
    public string $_session_cookie_name;
    public int $_session_rotation_time;
    public string $_session_cookie_expiration_time;
    public bool $_remember_me_enabled;
    public string $_remember_me_cookie_name;
    public int $_remember_me_expiration;
    public bool $_remember_me_match_ip;
    public bool $_remember_me_match_ip_mask;
    public bool $_multiple_logins;
    public bool $_is_cookie_encrypted;
    public ?int $_user_id = NULL;
    public ?string $_current_session_token = NULL;
    public ?int $_session_id = NULL;
    public ?array $_remember_me = NULL;
    public ?Database0implement $_database0implement = NULL;

    function __construct()
    {
        $this->_user_table_name = static::_credential()['user_table_name'];
        $this->_session_table_name = static::_credential()['session_table_name'];
        $this->_session_cookie_name = static::_credential()['session_cookie_name'];
        $this->_session_rotation_time = (int) static::_credential()['session_rotation_time'];
        $this->_session_cookie_expiration_time = static::_credential()['session_cookie_expiration_time'];
        $this->_remember_me_enabled = static::_credential()['remember_me_enabled'];
        $this->_remember_me_cookie_name = static::_credential()['remember_me_cookie_name'];
        $this->_remember_me_expiration = static::_credential()['remember_me_expiration'];
        $this->_remember_me_match_ip = static::_credential()['remember_me_match_ip'];
        $this->_remember_me_match_ip_mask = static::_credential()['remember_me_match_ip_mask'];
        $this->_multiple_logins = static::_credential()['multiple_logins'];
        $this->_is_cookie_encrypted = static::_cookie_setting()['encrypt'];
        $this->_current_session_token = $this->get_cookie($this->_session_cookie_name);
        $remember_me = $this->get_cookie($this->_remember_me_cookie_name);
        $this->_remember_me = $remember_me === '' ? [] : $remember_me;
        $this->_database0implement = database_implement(CSL_DB_INSTANCE_PRIMARY);
    }

    function login($user_name, $password) : bool
    {
        $user = $this->_find_user_by_name($user_name);
        if (static::_verify_password_hash($user['password_hash'], $password) === false)
            return false;
        $session_token = generate_token();
        $params = [
            'token'  => $session_token,
            'user_id' => $user['id'],
            'rotated_at' => time()
        ];
        if ($this->_session_id === NULL) {
            $this->_database0implement
                ->store(
                    $this->_session_table_name,
                    ['token' => $session_token],
                    $params
                );
        } else {
            $this->_database0implement
            ->update_by_key(
                $this->_session_table_name,
                $this->_session_id,
                $params
            );
        }
        $this->set_cookie($this->_session_cookie_name, $session_token);
        return true;
    }

    function logout($user_name) : bool
    {
        if ($this->_user_id === NULL)
            return true;
        $params = [
            'rotated_at'  => 0,
            'is_logged_in'  => 0,
            'user_id'  => 0
        ];
        $this->_database0implement->update_by_key($this->_session_table_name, $this->_session_id, $params);
        return true;
    }

    function check() : array
    {
        $session = $this->_find_session_by_token($this->_current_session_token);
        if (count($session) === 0)
            return [false, []];
        $this->_session_id = $session['id'];
        if ($session['user_id'] === '')
            return [false, []];
        $this->_user_id = $session['user_id'];
        $session_token = generate_token();
        if ((int) $session['rotated_at'] + $this->_session_rotation_time > time())
        {
            $params = [
                'token'  => generate_token(),
                'rotated_at'  => time()
            ];
            $this->_database0implement->update_by_key($this->_session_table_name, $this->_session_id, $params);
        }
        $this->set_cookie($this->_session_cookie_name, $session_token);
        return [true, ['user_id' => $this->_user_id]];
    }

    function _find_user_by_name(string $name) : array
    {
        return database_implement(CSL_DB_INSTANCE_PRIMARY)
            ->find_one_by($this->_user_table_name, 'name', $name);
    }

    function _find_session_by_token(string $session_token) : array
    {
        return database_implement(CSL_DB_INSTANCE_PRIMARY)
            ->find_one_by($this->_session_table_name, 'token', $session_token);
    }

    function _update_session(int $id, array $fields)
    {
        $this->_database0implement
            ->update_by_key($this->_session_table_name, $id, $fields);
    }

    function _store_session(array $params)
    {
        $this->_database0implement
            ->store(
                $this->_session_table_name,
                ['token'],
                $params
            );
    }

    function _password_hash(string $password) : string|bool
    {
        if (mb_check_encoding($password, 'ASCII') === false)
            return false;
        if (strlen($password) > self::MAX_PASSWORD_LENGTH)
            return false;
        try
        {
            return sodium_crypto_pwhash_str($password, SODIUM_CRYPTO_PWHASH_OPSLIMIT_INTERACTIVE, SODIUM_CRYPTO_PWHASH_MEMLIMIT_INTERACTIVE);
        } catch (Throwable $t) {
            static::_log_info($t);
            return false;
        }
    }

    function _verify_password_hash(string $hash, string $password) : bool
    {
        try
        {
            return sodium_crypto_pwhash_str_verify($hash, $password);
        } catch (Throwable $t) {
            static::_log_info($t);
            return false;
        }
    }

    function _retrieve_session() : array
    {
        return database_implement(CSL_DB_INSTANCE_PRIMARY)
            ->find_one_by(static::_credential()['session_table_name'], 'token', $this->_current_session_token);
    }

    function set_cookie(string $cookie_name, array|string $value, int $expiration = 3600, string $path = '', string $domain = '') : bool
    {
        $value = is_array($value) ? json_encode($value) : $value;
        if ($this->_is_cookie_encrypted === true)
            $value = secret_box($value, static::_cookie_setting()['encrypt_key']);
        store_cookie($cookie_name, $value, time() + $expiration, $path, $domain);
        return true;
    }

    function get_cookie(string $cookie_name) : array|string
    {
        $cookie_value = array_key_exists($cookie_name, static::_captured_cookie_values()) ? static::_captured_cookie_values()[$cookie_name] : '';
        $cookie_value = $this->_is_cookie_encrypted ? secret_box_open($cookie_value, static::_cookie_setting()['encrypt_key']) : $cookie_value;
        return json_decode($cookie_value, true) ?? $cookie_value;
    }

    function delete_cookie(string $cookie_name) : bool
    {
        store_cookie($cookie_name, '', time() - static::COOKIE_DELETE_SEC);
        return true;
    }

    function _is_ip_addresses_identical(string $ip_address_1, string $is_address_2, int $mask) : bool
    {
        $ip_address_int_1 = ip2long($ip_address_1);
        $ip_address_int_2 = ip2long($is_address_2);
        if (is_int($ip_address_int_1) AND is_int($ip_address_int_2))
        {
            $ip_address_int_1_shifted = $ip_address_int_1 >> (32 - $mask);
            $is_address_int_2_shifted = $ip_address_int_2 >> (32 - $mask);
            return $ip_address_int_1_shifted === $is_address_int_2_shifted;
        } else {
            return false;
        }
    }
}