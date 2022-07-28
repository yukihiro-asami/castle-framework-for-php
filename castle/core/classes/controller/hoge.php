<?php
namespace castle;
class Controller_Hoge extends Controller
{
    function hoge(){
        $syslog_id = self::_value('syslog_id');
        echo <<<EOF
<html>
<head></head>
<body>hoge</body>
<a href="/syslog.php?syslog_id=$syslog_id">syslog_id</a>
</html>
EOF;

    }
}