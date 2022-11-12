<?php
class Controller_Hoge extends Controller
{
    function get_index(string $hoge = ' no param')
    {
        $ip = Input::ip();
        $ua = Input::user_agent();
        $result_of_check = Auth::check();
        $result_of_check = $result_of_check ? 'true' : 'false';
        $user_id = Auth::get_user_id();
        return Response::forge(
            View::forge($this->_view_filename,
            [
                'ip' => $ip,
                'result_of_check' => $result_of_check,
                'user_id' => $user_id,
                'ua' => $ua
            ]
            )
        );
    }
}