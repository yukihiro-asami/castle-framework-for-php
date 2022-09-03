<?php
namespace castle;
CONST DB_TYPE_TO_CLASS =[
    'pdo'  => 'Database0implement_PDO'
];
return function (array &$vals) : string
{
    $setting = $vals['dbs'][0];
    set_database(new Database0implement_PDO($setting['dsn'], $setting['username'], $setting['password']));
    return 'success';
};