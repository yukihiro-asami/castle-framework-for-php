<?php
class Controller_Logout extends Controller
{
    function get_index(string $hoge = ' no param')
    {
        global $__credential;
        $__credential->logout();
        return Response::forge('ok');
    }
}