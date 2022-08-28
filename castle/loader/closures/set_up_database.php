<?php
namespace castle;
CONST DB_TYPE_TO_CLASS =[
    'pdo'  => 'Database0implement_PDO'
];
return function (array &$vals) : string
{
    $setting = $vals['dbs'][0];
    $pdo = new Database0implement_PDO($setting['dsn'], $setting['username'], $setting['password']);
    $pdo->start_transaction();
    /*
    try
    {
        $pdo->query('INSERT INTO users SET name = :name, address = :address');
        $name = 'あさみん';
        $address = '静岡県';
        $pdo->bind('name', $name);
        $pdo->bind('address', $address);
        $pdo->execute();
        $pdo->query('INSERT INTO users SET nam = :name, address = :address');
        $name = 'あさみん';
        $address = '静岡県';
        $pdo->bind('name', $name);
        $pdo->bind('address', $address);
        $pdo->execute();
        $pdo->commit_transaction();
    } catch (\Throwable) {
        $pdo->rollback_transaction();
    }

    print_r($pdo->_log);
    */
    $string = "Co'mpl''ex \"st'\"ring";
    echo $pdo->quote($string);
    return 'success';
};