<?php
class Controller_Hoge extends Controller
{
    function get_index(string $hoge = ' no param')
    {
        trigger_error('trigger error');
        echo View::forge($this->_view_filename, ['value' => $hoge])->render();
    }
}