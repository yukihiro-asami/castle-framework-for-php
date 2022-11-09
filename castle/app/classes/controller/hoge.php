<?php
class Controller_Hoge extends Controller
{
    function get_index(string $hoge = ' no param')
    {
        global $__credential;
        $is_logged_in = $__credential->check() ? 'true' : 'false';
        $user_id = $__credential->get_user_id();
        return Response::forge(
            View::forge($this->_view_filename,
            [
                'is_logged_in' => $is_logged_in,
                'user_id' => $user_id
            ]
            )
        );
    }
}