<?php /** @noinspection PhpUnused */
namespace castle;
class Table extends Castle
{
    protected static string $_table_name;
    protected static string $_primary_key = 'id';
    protected static array $_unique_keys;
    protected static int $_database_index = CSL_DB_INSTANCE_PRIMARY;

    public static function store($column_and_values) : bool
    {
        return database_implement(static::$_database_index)->store(static::$_table_name, static::$_unique_keys, $column_and_values);
    }
    public static function find_by_pk(int|string $value) : array
    {
        return database_implement(static::$_database_index)->find_by(static::$_table_name, static::$_primary_key, $value);
    }
}