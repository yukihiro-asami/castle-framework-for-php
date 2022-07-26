<?php
namespace castle;
class Controller_Hoge extends Controller
{
    function hoge(){
        $this->_log_info('hoge');
        echo <<<EOF
<html>
<head></head>
<body>hoge</body>
</html>
EOF;

    }
}