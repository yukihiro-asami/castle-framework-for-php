<?php
class Controller_Hoge extends Controller
{
    function get_index(string $hoge = ' no param')
    {
        //Credential::set_cookie('hoge', array('value'  =>  'hage'), 3600);
        $cookie = Credential::get_cookie('hoge');
        return Response::forge(View::forge($this->_view_filename, ['value' => $cookie['value']]));
    }
}