<?php
class Test_Class_Credential extends TestCase
{

    function test_is_ip_addresses_identical_01()
    {
        $credential0implement = new \castle\Credential0implement();
        $result = $credential0implement->_is_ip_addresses_identical('0.0.0.0', '0.0.0.1000', 32);
        $this->assertFalse($result);
        $result = $credential0implement->_is_ip_addresses_identical('0.0.0.1000', '0.0.0.0', 32);
        $this->assertFalse($result);
        $result = $credential0implement->_is_ip_addresses_identical('a', 'a', 32);
        $this->assertFalse($result);
        $result = $credential0implement->_is_ip_addresses_identical('0.0.0.0', '0.0.0.0', 32);
        $this->assertTrue($result);
        $result = $credential0implement->_is_ip_addresses_identical('255.255.255.255', '255.255.255.255', 32);
        $this->assertTrue($result);
        $result = $credential0implement->_is_ip_addresses_identical('0.0.0.0', '0.0.0.1', 32);
        $this->assertFalse($result);
        $result = $credential0implement->_is_ip_addresses_identical('0.0.0.0', '0.0.0.0', 24);
        $this->assertTrue($result);
        $result = $credential0implement->_is_ip_addresses_identical('0.0.0.0', '0.0.0.1', 24);
        $this->assertTrue($result);
        $result = $credential0implement->_is_ip_addresses_identical('0.0.0.0', '0.0.1.1', 24);
        $this->assertfalse($result);
        $result = $credential0implement->_is_ip_addresses_identical('0.0.0.0', '0.0.0.0', 16);
        $this->assertTrue($result);
        $result = $credential0implement->_is_ip_addresses_identical('0.0.0.0', '0.0.1.1', 16);
        $this->assertTrue($result);
        $result = $credential0implement->_is_ip_addresses_identical('0.0.0.0', '0.0.0.0', 16);
        $this->assertTrue($result);
        $result = $credential0implement->_is_ip_addresses_identical('0.0.0.0', '0.1.1.1', 16);
        $this->assertFalse($result);
        $result = $credential0implement->_is_ip_addresses_identical('0.0.0.0', '0.0.0.0', 8);
        $this->assertTrue($result);
        $result = $credential0implement->_is_ip_addresses_identical('0.0.0.0', '0.0.1.1', 8);
        $this->assertTrue($result);
        $result = $credential0implement->_is_ip_addresses_identical('0.0.0.0', '0.1.1.1', 8);
        $this->assertTrue($result);
        $result = $credential0implement->_is_ip_addresses_identical('0.0.0.0', '1.1.1.1', 8);
        $this->assertFalse($result);
    }

    function test_password_hash()
    {
        $credential0implement = new \castle\Credential0implement();
        $pw_1 = 'hagehage';
        $pw_hash_1 = $credential0implement->_password_hash($pw_1);
        $result = $credential0implement->_verify_password_hash($pw_hash_1, $pw_1);
        $this->assertTrue($result);
        $result = $credential0implement->_verify_password_hash($pw_hash_1, $pw_1 . 'a');
        $this->assertFalse($result);
        $result = $credential0implement->_verify_password_hash($pw_hash_1 . 'hoge', $pw_1);
        $this->assertFalse($result);
        $pw_2 = 'ほげほげ';
        $pw_hash_2 = $credential0implement->_password_hash($pw_2);
        $this->assertFalse($pw_hash_2);
        $pw_3 = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
        $pw_hash_3 = $credential0implement->_password_hash($pw_3);
        $is_string = is_string($pw_hash_3);
        $this->assertFalse($is_string);
        $pw_4 = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
        echo $pw_hash_4 = $credential0implement->_password_hash($pw_4);
        $is_string_2 = is_string($pw_hash_4);
        $this->assertTrue($is_string_2);
    }

    function test_cookie()
    {
        global $__vals;
        $__vals['captured_cookie_values'] = ['hoge'  =>  'hogehoge'];
        $credential0implement = new \castle\Credential0implement();
        echo $credential0implement->get_cookie('hoge') . PHP_EOL;
    }

    function test_init_session()
    {
        global $__vals;
        $__vals['captured_cookie_values'] = ['session_info'  =>  'hogehoge'];
        $credential0implement = new \castle\Credential0implement();
        echo $credential0implement->_current_session_token . PHP_EOL;
    }

    function test_session_store_and_find()
    {
        $token = 'hogehoge';
        $fields = ['token' => $token, 'is_logged_in' => 1, 'user_id' => 10, 'rotated_at' => time()];
        $credential0implement = new \castle\Credential0implement();
        $credential0implement->_store_session($fields);
        $result = $credential0implement->_find_session_by_token($token);
        print_r($result);
        $fields_2 = ['token' => $token, 'is_logged_in' => 0, 'user_id' => 0, 'rotated_at' => 0];
        $credential0implement->_store_session($fields_2);
        $result = $credential0implement->_find_session_by_token($token);
        print_r($result);
        $token_2 = 'hagehage';
        $fields_3 = ['token' => $token_2, 'is_logged_in' => 1, 'user_id' => 10, 'rotated_at' => time()];
        $credential0implement->_update_session($result['id'], $fields_3);
        $result = $credential0implement->_find_session_by_token($token_2);
        print_r($result);
    }
}