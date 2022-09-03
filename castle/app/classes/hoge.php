<?php

class Hoge
{
    public function hoge() : string
    {
        $result = DB::query('SELECT * FROM `users`')->execute();
        echo 'result';
        print_r($result);
        return 'hoge form hoge class';
    }
}