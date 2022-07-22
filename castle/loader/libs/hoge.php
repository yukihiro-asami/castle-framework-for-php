<?php
namespace castle;
function hoge(string $message)
{
   echo <<<EOF
<html>
<head></head>
<body>
    <p>hoge</p>
    <p>$message</p>
</body>
</html>
EOF;


};