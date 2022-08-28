<?php
class Controller_Hoge extends Controller
{
    function get_index(string $hoge = ' no param')
    {
        echo View::forge($this->_view_filename, ['value' => $hoge])->render();
    }
}