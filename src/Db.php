<?php


class Db
{
    protected $dbh;
    protected static $connection;

    protected function __construct()
    {

        $db = include __DIR__ . '/conf.php';
        $this->dbh = new PDO($db['driver'] . ':dbname=' . $db['dbname'] . ';host=' . $db['host'], $db['user'], $db['pass']);

    }

    public static function getInstance()
    {
        if (static::$connection === null) {
            static::$connection = new static();
        }
        return static::$connection;
    }

    public function execute(string $sql, array $data = [])
    {
        $sth = $this->dbh->prepare($sql);
        $result = $sth->execute($data);
        if (false === $result) {
            var_dump($sth->errorInfo());
            die;
        }
        return true;
    }

    public function query(string $sql, array $data = [], $class = null)
    {
        $sth = $this->dbh->prepare($sql);
        $result = $sth->execute($data);
        if (false === $result) {
            var_dump($sth->errorInfo());
            die;
        }
        if (null === $class) {
            return $sth->fetch(PDO::FETCH_ASSOC);
        } else {
            return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
        }
    }

    public function queryEach(string $sql, array $data = [], $class = null)
    {
        $sth = $this->dbh->prepare($sql);
        $result = $sth->execute($data);
        if (false === $result) {
            var_dump($sth->errorInfo());
            die;
        }
        if (null === $class) {
            while ($row = $sth->fetch()) {
                yield $row;
            }
        } else {
            $sth->setFetchMode(\PDO::FETCH_CLASS, $class);
            while ($row = $sth->fetch()) {
                yield $row;
            }
        }
    }

    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }
}