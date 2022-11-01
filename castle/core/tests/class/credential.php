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
        $pw_3 = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
        $pw_hash_3 = $credential0implement->_password_hash($pw_1);
        $is_string = $is_string($pw_hash_3);

    }
}