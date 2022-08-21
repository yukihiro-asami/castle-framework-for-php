<?php
class Controller_Hoge extends Controller
{
    function get_index(string $hoge = ' no param')
    {
        Response::forge('hoge' . $hoge);
    }
}