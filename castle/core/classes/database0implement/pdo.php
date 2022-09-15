<?php /** @noinspection PhpUnused */
namespace castle;
use PDO;

class Database0implement_PDO extends Database0implement
{
    protected string $_dsn;
    protected string $_user;
    protected string $_password;
    protected ?PDO $_pdo = NULL;

    function __construct($dsn, $user, $password)
    {
        $this->_dsn = $dsn;
        $this->_user = $user;
        $this->_password = $password;
    }

    function _connect_db()
    {
        $this->_pdo = new PDO($this->_dsn, $this->_user, $this->_password);
    }

    public function query(string $sql) : Database0implement
    {
        $this->_sql = $sql;
        return $this;
    }

    public function bind(string $name, string|int|float & $value) : Database0implement
    {
        $this->_params[$name] =& $value;
        return $this;
    }

    public function param(string $name, string|int|float $value) : Database0implement
    {
        $this->_params[$name] = $value;
        return $this;
    }

    public function params(array $name_and_values) : Database0implement
    {
        array_map(
            function ($name) use ($name_and_values) {
                if (in_array(gettype($name_and_values[$name]), ['string', 'integer', 'double']))
                    $this->_params[$name] = $name_and_values[$name];
            },
            array_keys($name_and_values)
        );
        return $this;
    }

    /**
     * @throws \Throwable
     * @noinspection PhpFullyQualifiedNameUsageInspection
     */
    public function execute() : array
    {
        if ($this->_pdo === NULL)
            $this->_connect_db();
        try
        {
            echo $this->_sql;
            $pdo_statement = $this->_pdo->prepare($this->_sql);
            $this->_count = $pdo_statement->execute($this->_params);
            $result = $this->_result = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $throwable) {
            $this->_error = $throwable->getMessage();
            $this->_log_and_init_params_and_query();
            throw $throwable;
        }
        $this->_error = implode(' | ', $this->_pdo->errorInfo());
        $this->_log_and_init_params_and_query();
        return $result;
    }

    public function quote(string $string) : string
    {
        if ($this->_pdo === NULL)
            $this->_connect_db();
        return $this->_pdo->quote($string);
    }

    public function start_transaction() : bool
    {
        if ($this->_pdo === NULL)
            $this->_connect_db();
        $detail['result'] = $this->_pdo->beginTransaction();
        store_database_log($this->_database_index,static::START_TRANSACTION, $detail);
        return $detail['result'];
    }

    public function commit_transaction() : bool
    {
        $detail['result'] = $this->_pdo->commit();
        store_database_log($this->_database_index,static::COMMIT_TRANSACTION, $detail);
        return $detail['result'];
    }

    public function rollback_transaction() : bool
    {
        $detail['result'] = $this->_pdo->rollBack();
        store_database_log($this->_database_index, static::ROLLBACK_TRANSACTION, $detail);
        return $detail['result'];
    }

    public function store(string $table_name, array $unique_keys, array $column_and_values) : bool
    {
        $columns = [];
        $values = [];
        $on_duplicate = [];
        foreach ($column_and_values as $column => $value)
        {
            $columns[] = "`$column`";
            $values[] = ":$column";
            if (in_array($column, $unique_keys) === false)
                $on_duplicate[] = "`$column` = VALUES(`$column`)";
        }
        $sql = "INSERT INTO `$table_name` (" . implode(',', $columns) . ") VALUES (" . implode(', ', $values)
            . ") ON DUPLICATE KEY UPDATE " . implode(',', $on_duplicate);
        $this->query($sql)->params($column_and_values)->execute();
        return true;
    }

    public function store_records(string $table_name, array $unique_keys, array $records): bool
    {
        $columns = [];
        $sql_records = [];
        $on_duplicate = [];
        if (count($records) > static::STORE_RECORDS_MAX_COUNT)
            throw new \Exception();
        foreach (array_keys($records[0]) as $column)
        {
            $columns[] = "`$column`";
            if (in_array($column, $unique_keys) === false)
                $on_duplicate[] = "`$column` = VALUES(`$column`)";
        }
        foreach ($records as $record)
        {
            $processed_records = [];
            foreach (array_keys($records[0]) as $column)
            {
                if (gettype($record[$column]) === 'string')
                {
                    $processed_records[$column] = $this->quote($record[$column]);
                } else {
                    $processed_records[$column] = $record[$column];
                }
            }
            $sql_records[] = '(' . implode(', ', $processed_records) . ')';
        }
        $sql = "INSERT INTO `$table_name` (" . implode(',', $columns) . ") VALUES " . implode(', ', $sql_records)
        . " ON DUPLICATE KEY UPDATE " . implode(',', $on_duplicate);
        echo $sql;
        $this->query($sql)->execute();
        return true;
    }

    public function find_by(string $table_name, string $column, string|int $value, string $operator = '=', ?int $limit = NULL, int $offset = 0) : array
    {
        $sql = "SELECT * FROM `$table_name` WHERE :column $operator :value"
            . ($limit === NULL ? '' : " limit $limit")
            . ($offset === 0 ? '' : " offset $offset");
        echo $sql;
        return $this->query($sql)->params(['column'  =>  $column, 'value'  => $value])->execute();
    }

}