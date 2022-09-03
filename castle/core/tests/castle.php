<?php
class Test_Hoge extends TestCase
{
    public function test_hoge1() {
        $obj = new Hoge();
        echo $obj->hoge();
    }
}