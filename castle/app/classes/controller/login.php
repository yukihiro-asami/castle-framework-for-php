<?php
class Controller_Login extends Controller
{
    function get_index(string $hoge = ' no param')
    {
        global $__credential;
        $__credential->login('hogehoge', 'hoge1234');
        return Response::forge('ok');
    }
}