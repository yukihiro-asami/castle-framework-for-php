<?php
namespace castle;
class Controller_Hoge extends Controller
{
    function hoge(){
        echo <<<EOF
<html>
<head></head>
<body>hoge</body>
</html>
EOF;

    }
}