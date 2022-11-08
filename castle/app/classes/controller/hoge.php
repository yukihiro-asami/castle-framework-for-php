<?php
class Controller_Hoge extends Controller
{
    function get_index(string $hoge = ' no param')
    {
        Cookie::set('hoge', ['hoge' => 'hogehoge']);
        $cookie = json_encode(Cookie::get('hoge'));
        return Response::forge(View::forge($this->_view_filename, ['value' => $cookie]));
    }
}