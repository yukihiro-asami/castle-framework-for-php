<?php
class Controller_Hoge extends Controller
{
    function get_index(string $hoge = ' no param')
    {
        $ip = Input::ip();
        $ua = Input::user_agent();
        $result_of_check = Auth::check();
        global $__credential;
        $result_of_check_remember_me = $__credential->check_remember_me();
        $result_of_check = $result_of_check ? 'true' : 'false';
        $result_of_check_remember_me = $result_of_check_remember_me ? 'true' : 'false';
        $user_id = Auth::get_user_id();
        return Response::forge(
            View::forge($this->_view_filename,
            [
                'ip' => $ip,
                'result_of_check' => $result_of_check,
                'result_of_check_remember_me' => $result_of_check_remember_me,
                'user_id' => $user_id,
                'ua' => $ua
            ]
            )
        );
    }
}