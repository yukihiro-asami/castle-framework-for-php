<?php
namespace castle;
return function (array &$vals) : string
{
    $html = <<<EOF
<html>
<head></head>
<body>
<p>from_process_controller</p>
</body>
</html>
EOF;
    store_body($html);
    return 'success';
};