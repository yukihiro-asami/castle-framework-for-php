<?php
class Test_Hoge extends TestCase
{
    public function test_hoge1() {
        $records = [
            ['name' => 'あさみん', 'address' => 'hoge1', 'age' => 1],
            ['name' => 'あさみん1', 'address' => 'hoge2', 'age' => 2],
            ['name' => 'あさみん2', 'address' => 'hoge3', 'age' => 3],
            ['name' => 'あさみん3', 'address' => 'hoge4', 'age' => 4],
            ['name' => 'あさみん4', 'address' => 'hoge5', 'age' => 5],
            ['name' => 'あさみん5', 'address' => 'hoge6', 'age' => 6],
            ['name' => 'あさみん6', 'address' => 'hoge7', 'age' => 7],
            ['name' => 'あさみん7', 'address' => 'hoge8', 'age' => 8],
            ['name' => 'あさみん8', 'address' => 'hoge9', 'age' => 9],
            ['name' => 'あさみん9', 'address' => 'hoge10', 'age' => 10],
            ['name' => 'あさみん10', 'address' => 'hoge11', 'age' => 11]
        ];
        \castle\database_implement(0)->store_records('users', ['name'], $records);
    }
}