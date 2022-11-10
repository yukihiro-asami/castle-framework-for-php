<?php
class Controller_Login extends Controller
{
    function get_index(string $hoge = ' no param')
    {
        Auth::login('hogehoge', 'hoge1234');
        return Response::forge('ok');
    }
}