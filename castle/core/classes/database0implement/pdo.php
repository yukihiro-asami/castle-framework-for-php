<?php /** @noinspection PhpUnused */
namespace castle;
use PDO;
class Database0implement_PDO extends Database0implement
{
    protected string $_dsn;
    protected string $_user;
    protected string $_password;
    protected ?PDO $_pdo = NULL;
    protected string $_sql = '';
    protected array $_params = [];
    protected int $_count = 0;
    public array $_log = [];
    protected string $_error = '';
    const EXECUTE_QUERY = 'execute_query';
    const START_TRANSACTION = 'start_transaction';
    const COMMIT_TRANSACTION = 'commit_transaction';
    const ROLLBACK_TRANSACTION = 'rollback_transaction';
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
    function _log_and_init_params_and_query() : void
    {
        $this->_log_database(self::EXECUTE_QUERY,
            [
                'sql'  =>  $this->_sql,
                'params'  => $this->_params,
                'count'  =>  $this->_count,
                'error'  => $this->_error
            ]
        );
        $this->_sql = '';
        $this->_params = [];
        $this->_count = 0;
        $this->_error = '';
    }
    function _log_database(string $operation, array $detail) : void
    {
        $this->_log[] = [
            'operation' => $operation,
            'detail' => $detail
        ];
    }
    function _retrieve_log() : array
    {
        return $this->_log;
    }
    /** @noinspection PhpParameterNameChangedDuringInheritanceInspection */
    public function query(string $sql)
    {
        $this->_sql = $sql;
    }
    public function bind(string $name, string|int|float & $value)
    {
        $this->_params[$name] =& $value;
    }
    public function param(string $name, string|int|float $value)
    {
        $this->_params[$name] = $value;
    }
    public function params(array $name_and_values)
    {
        array_map(
            function ($name) use ($name_and_values) {
                if (in_array(gettype($name_and_values[$name]), ['string', 'integer', 'double']))
                    $this->_params[$name] = $name_and_values[$name];
            },
            array_keys($name_and_values)
        );
    }
    /**
     * @throws \Throwable
     * @noinspection PhpFullyQualifiedNameUsageInspection
     */
    public function execute()
    {
        if ($this->_pdo === NULL)
            $this->_connect_db();
        try
        {
            $this->_count = $this->_pdo->prepare($this->_sql)
                ->execute($this->_params);
        } catch (\Throwable $throwable) {
            echo 're-throw';
            $this->_error = $throwable->getMessage();
            $this->_log_and_init_params_and_query();
            throw $throwable;
        }
        $this->_error = implode(' | ', $this->_pdo->errorInfo());
        $this->_log_and_init_params_and_query();
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
        $this->_log_database(static::START_TRANSACTION, $detail);
        return $detail['result'];
    }
    public function commit_transaction() : bool
    {
        $detail['result'] = $this->_pdo->commit();
        $this->_log_database(static::COMMIT_TRANSACTION, $detail);
        return $detail['result'];
    }
    public function rollback_transaction() : bool
    {
        $detail['result'] = $this->_pdo->rollBack();
        $this->_log_database(static::ROLLBACK_TRANSACTION, $detail);
        return $detail['result'];
    }
}