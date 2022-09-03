<?php /** @noinspection PhpUnused */
namespace castle;
class Table extends Castle
{
    protected string $_table_name;
    protected string $_primary_key;
    protected array $_unique_keys;
    protected int $_database_index = CSL_DB_INSTANCE_PRIMARY;
    public static function store($array)
    {

    }
}