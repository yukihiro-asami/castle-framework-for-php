<?php
class Controller_Hoge extends Controller
{
    function get_index(string $hoge = ' no param')
    {
        $ip = Input::ip();
        $ua = Input::user_agent();
        $is_logged_in = Auth::check() ? 'true' : 'false';
        $user_id = Auth::get_user_id();
        return Response::forge(
            View::forge($this->_view_filename,
            [
                'ip' => $ip,
                'is_logged_in' => $is_logged_in,
                'user_id' => $user_id,
                'ua' => $ua
            ]
            )
        );
    }
}