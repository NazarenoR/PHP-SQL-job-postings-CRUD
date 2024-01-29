<?php

namespace App\Db;

use \PDO;
use \PDOException;

class Database{
    /**
     * Database connection host
     * @var string
     */
    const HOST = 'localhost';

    /**
     * Database name
     * @var string
     */
    const NAME = 'job_postings';

    /**
     * Database user
     * @var string
     */
    const USER = 'root';

    /**
     * Database password
     * @var string
     */
    const PASS = '';

    /**
     * Database table
     * @var string
     */
    private $table;

    /**
     * PDO connection
     * @var PDO
     */
    private $connection;

    /**
     * Define the table and connect to the database
     * @param string $table
     */
    public function __construct($table = null){
        $this->table = $table;
        $this->setConnection();
    }

    /**
     * Creates a connection with the database
     */
    private function setConnection(){
        try{
            $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME, self::USER, self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die('ERROR: '.$e->getMessage());
        }
    }

    /**
     * Executes queries inside the database
     * @param  string $query
     * @param  array  $params
     * @return PDOStatement
     */
    public function execute($query, $params = []){
        try{
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
        }catch(PDOException $e){
            die('ERROR: '.$e->getMessage());
        }
    }


    /**
     * Inserts data into database
     * @param array $values [ field => value ]
     * @return integer ID of the inserted register
     */
    public function insert($values){
        //DATA OF THE QUERY
        $fields = array_keys($values);
        $binds  = array_pad([], count($fields), '?');

        //ASSEMBLE THE QUERY
        $query = 'INSERT INTO '.$this->table. '('.implode(',',$fields).') VALUES ('.implode(',',$binds).')';
        
        //EXECUTE INSERT
        $this->execute($query,array_values($values));

        //RETURN THE ID OF THE INSERTED REGISTER
        return $this->connection->lastInsertId();
    }

    /**
     * Executes a select query in the database
     * @param  string $where
     * @param  string $order
     * @param  string $limit
     * @param  string $fields
     * @return PDOStatement
     */
    public function select($where = null, $order = null, $limit = null, $fields = '*'){
        //DATA OF THE QUERY
        $where = strlen($where) ? 'WHERE '.$where : '';
        $order = strlen($order) ? 'ORDER BY '.$order : '';
        $limit = strlen($limit) ? 'LIMIT '.$limit : '';

        //ASSEMBLE THE QUERY
        $query = 'SELECT '.$fields.' FROM '.$this->table.' '.$where.' '.$order.' '.$limit;

        //EXECUTE THE QUERY
        return $this->execute($query);
    }

    /**
     * Executes an update query in the database
     * @param  string $where
     * @param  array  $values [ field => value ]
     * @return boolean
     */
    public function update($where, $values){
        //DATA OF THE QUERY
        $fields = array_keys($values);

        //ASSEMBLE THE QUERY
        $query = 'UPDATE '.$this->table.' SET '.implode('=?,',$fields).'=? WHERE '.$where;

        //EXECUTE THE QUERY
        $this->execute($query,array_values($values));

        //RETURN SUCCESS
        return true;
    }

    /**
     * Executes a delete query in the database
     * @param  string $where
     * @return boolean
     */
    public function delete($where){
        //ASSEMBLE THE QUERY
        $query = 'DELETE FROM '.$this->table.' WHERE '.$where;

        //EXECUTE THE QUERY
        $this->execute($query);

        //RETURN SUCCESS
        return true;
    }
}